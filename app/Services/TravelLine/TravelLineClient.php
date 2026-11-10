<?php
namespace App\Services\TravelLine;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Client\Response;
class TravelLineClient
{
    private function settings(): SiteSetting
    {
        $s = SiteSetting::query()->orderBy('id')->first();
        if (!$s?->travelline_api_enabled) throw new TravelLineException('disabled');
        return $s;
    }
    public function propertyId(): string
    {
        $id = (string) $this->settings()->travelline_hotel_id;
        if ($id === '') throw new TravelLineException('property');
        return $id;
    }
    private function identity(SiteSetting $s): string
    {
        return hash('sha256', $s->id . '|' . $s->travelline_client_id . '|' . $s->getRawOriginal('travelline_client_secret'));
    }
    private function limit(string $bucket, array $limits): void
    {
        $s = $this->settings();
        foreach ($limits as [$max, $seconds]) {
            $key = 'tl-api-limit:' . $s->id . ':' . $bucket . ':' . $seconds;
            if (RateLimiter::tooManyAttempts($key, $max)) throw new TravelLineException('limit', 429, RateLimiter::availableIn($key));
        }
        foreach ($limits as [$max, $seconds]) RateLimiter::hit('tl-api-limit:' . $s->id . ':' . $bucket . ':' . $seconds, $seconds);
    }
    private function response(Response $r): array
    {
        if (!$r->successful()) {
            $reason = match ($r->status()) {401=>'auth',403=>'forbidden',429=>'limit',default=>'upstream'};
            throw new TravelLineException($reason, $r->status(), max(0, min(3600, (int) $r->header('Retry-After'))));
        }
        $data = $r->json();
        if (!is_array($data)) throw new TravelLineException('response');
        return $data;
    }
    private function token(SiteSetting $s): string
    {
        if (!$s->travelline_client_id || !$s->travelline_client_secret) throw new TravelLineException('credentials');
        $key = 'tl-oauth:' . $this->identity($s);
        if ($value = Cache::get($key)) return Crypt::decryptString($value);
        try {
            return Cache::lock($key . ':lock', 30)->block(5, function () use ($s, $key) {
                if ($value = Cache::get($key)) return Crypt::decryptString($value);
                $this->limit('auth', [[3,1],[15,60],[300,3600]]);
                try {
                    $r = Http::asForm()->acceptJson()->connectTimeout(5)->timeout(15)->withoutRedirecting()
                        ->post(config('travelline.host') . '/auth/token', [
                            'grant_type'=>'client_credentials','client_id'=>$s->travelline_client_id,'client_secret'=>$s->travelline_client_secret,
                        ]);
                } catch (\Throwable $e) { throw new TravelLineException('connection'); }
                $d = $this->response($r);
                if (empty($d['access_token']) || !is_string($d['access_token'])) throw new TravelLineException('response');
                $ttl = max(1, min(840, (int) ($d['expires_in'] ?? 900) - 60));
                Cache::put($key, Crypt::encryptString($d['access_token']), $ttl);
                return $d['access_token'];
            });
        } catch (\Illuminate\Contracts\Cache\LockTimeoutException $e) { throw new TravelLineException('connection'); }
    }
    private function request(string $api, string $method, string $path, array|string $data = []): array
    {
        if (!in_array($api, ['content','search','reservation'], true)) throw new TravelLineException('upstream');
        $s = $this->settings();$oauth = $s->travelline_auth_mode !== 'api_key';
        if (!$oauth && $api === 'reservation') throw new TravelLineException('oauth_required');
        if (!$oauth && !$s->travelline_api_key) throw new TravelLineException('credentials');
        for ($attempt = 0; $attempt < 2; $attempt++) {
            $credential = $oauth ? $this->token($s) : $s->travelline_api_key;
            $this->limit('all', [[45,1],[180,60],[2700,3600]]);
            if ($api === 'search') $this->limit('search', [[45,1],[180,60],[900,3600]]);
            try {
                $http = Http::acceptJson()->connectTimeout(5)->timeout(15)->withoutRedirecting();
                $http = $oauth ? $http->withToken($credential) : $http->withHeaders(['X-API-KEY'=>$credential]);
                $options = $method === 'GET' ? ['query'=>$data] : ['json'=>$data];
                $r = $http->send($method, config('travelline.host') . '/api/' . $api . '/' . ltrim($path, '/'), $options);
            } catch (\Throwable $e) { throw new TravelLineException('connection'); }
            // Only safe reads can be repeated after reauthorization; never repeat creation automatically.
            if ($oauth && $method === 'GET' && $r->status() === 401 && $attempt === 0) {
                Cache::forget('tl-oauth:' . $this->identity($s));continue;
            }
            return $this->response($r);
        }
        throw new TravelLineException('auth', 401);
    }
    public function property(bool $fresh = false): array
    {
        $id = $this->propertyId();$s = $this->settings();
        $key = 'tl-content:' . hash('sha256', $id . '|' . $this->identity($s) . '|' . $s->travelline_auth_mode . '|' . $s->getRawOriginal('travelline_api_key'));
        if (!$fresh && ($cached = Cache::get($key))) return $cached;
        $data = $this->request('content','GET','v1/properties/' . rawurlencode($id));
        Cache::put($key, $data, 300);
        return $data;
    }
    public function search(string $arrival, string $departure, int $adults, array $childAges = []): array
    {
        $id = $this->propertyId();
        // Repeated query parameters match the OpenAPI form/explode array serialization.
        $query = http_build_query(['arrivalDate'=>$arrival,'departureDate'=>$departure,'adults'=>$adults]);
        foreach ($childAges as $age) $query .= '&childAges=' . (int) $age;
        return $this->request('search','GET','v1/properties/' . rawurlencode($id) . '/room-stays', $query);
    }
    public function verifyBooking(array $booking): array
    {
        $booking['propertyId'] = $this->propertyId();
        return $this->request('reservation','POST','v1/bookings/verify',['booking'=>$booking]);
    }
    public function createBooking(array $booking): array
    {
        // Public checkout and idempotency/reconciliation are not connected yet.
        // Keep fail-closed even when valid credentials are subsequently entered.
        throw new TravelLineException('writes_disabled');
    }
}
