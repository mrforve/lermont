<?php
namespace App\Support;
use App\Models\SiteSetting;
use App\Models\ContactRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;
class MaxNotifier
{
    public function sendText(string $text, ?SiteSetting $settings = null): string
    {
        $settings ??= SiteSetting::query()->orderBy('id')->first();
        if (!$settings || !$settings->max_bot_token || !preg_match('/^-?[0-9]+$/', (string) $settings->max_chat_id)) {
            throw new RuntimeException('MAX: token or numeric chat ID is missing.');
        }
        try {
            $response = Http::withHeaders(['Authorization' => $settings->max_bot_token])
                ->acceptJson()->connectTimeout(5)->timeout(12)
                ->withOptions(['verify' => storage_path('app/max-ca-bundle.pem')])
                ->post('https://platform-api2.max.ru/messages?' . http_build_query([
                    'chat_id' => $settings->max_chat_id, 'disable_link_preview' => 'true',
                ]), ['text' => mb_substr($text, 0, 4000)]);
        } catch (\Throwable $e) {
            // Do not expose HTTP headers, response bodies or guest details in logs.
            throw new RuntimeException('MAX: connection failed; delivery will be retried.');
        }
        if (!$response->successful()) throw new RuntimeException('MAX: API returned HTTP ' . $response->status());
        $id = $response->json('message.body.mid');
        if (!is_string($id) || $id === '') throw new RuntimeException('MAX: message receipt is missing.');
        return $id;
    }
    public function contactText(ContactRequest $request): string
    {
        $header = "Новая заявка с hotel-lermont.ru\n№ " . $request->id
            . "\nИмя: " . $request->name
            . "\nТелефон: " . ($request->phone ?: 'не указан')
            . "\nEmail: " . ($request->email ?: 'не указан')
            . "\nТема: " . ($request->subject ?: 'Обращение с сайта');
        $link = "\n\nОткрыть в админке:\nhttps://hotel-lermont.ru/admin/contact-requests/" . $request->id . '/edit';
        $message = "\n\nСообщение:\n" . ($request->message ?: 'не указано');
        $remaining = 3990 - mb_strlen($header . $link);
        return $header . (mb_strlen($message) > $remaining ? mb_substr($message, 0, max(0, $remaining-1)) . '…' : $message) . $link;
    }
}
