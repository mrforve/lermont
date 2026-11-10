<?php
namespace App\Http\Controllers;
use App\Models\RoomType;
use App\Models\SiteSetting;
use App\Services\TravelLine\TravelLineClient;
use App\Services\TravelLine\TravelLineException;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
class TravelLinePreviewController extends Controller
{
    private function authorizeAdmin(Request $request): void { abort_unless($request->user('admin')?->canManageContent(), 403); }
    public function index(Request $request, TravelLineClient $client)
    {
        $this->authorizeAdmin($request);
        $result = null;$error = null;$content = [];
        if ($request->has('arrival')) {
            $today = CarbonImmutable::today('Europe/Moscow');
            $v = $request->validate([
                'arrival'=>['required','date_format:Y-m-d','after_or_equal:' . $today->toDateString(),'before_or_equal:' . $today->addDays(365)->toDateString()],
                'departure'=>['required','date_format:Y-m-d','after:arrival'],
                'adults'=>['required','integer','min:1','max:10'],
                'child_ages'=>['nullable','string','max:60','regex:/^\s*(?:[0-9]{1,2}\s*(?:,\s*[0-9]{1,2}\s*)*)?$/'],
            ]);
            $arrival = CarbonImmutable::parse($v['arrival']);$departure = CarbonImmutable::parse($v['departure']);
            if ($arrival->diffInDays($departure) > 100) return back()->withErrors(['departure'=>'Максимальная длительность проживания — 100 дней.']);
            $ages = trim($v['child_ages'] ?? '') === '' ? [] : array_map('intval', explode(',', $v['child_ages']));
            if (count($ages)>6 || array_filter($ages, fn($age)=>$age<0 || $age>18)) return back()->withErrors(['child_ages'=>'Укажите возраст каждого ребёнка от 0 до 18 лет, не более шести детей.']);
            try { $content = $client->property();$result = $client->search($v['arrival'],$v['departure'],(int)$v['adults'],$ages); }
            catch (TravelLineException $e) { $error = $e->getMessage(); }
        }
        return response()->view('integrations.travelline-preview',[
            'result'=>$result,'apiError'=>$error,'content'=>$content,
            'settings'=>SiteSetting::query()->orderBy('id')->first(),
            'localRooms'=>RoomType::query()->get()->keyBy('travelline_room_type_id'),
        ])->header('X-Robots-Tag','noindex, nofollow')->header('Cache-Control','no-store, private');
    }
    public function check(Request $request, TravelLineClient $client)
    {
        $this->authorizeAdmin($request);
        try { $property=$client->property(true);$message='Соединение установлено. Отель: ' . ($property['name']??$client->propertyId()) . '. Категорий в Content API: ' . count($property['roomTypes']??[]) . '. Поиск проверяется отдельно по датам; создание броней выключено.'; }
        catch (TravelLineException $e) { $message=$e->getMessage(); }
        return redirect()->route('travelline.preview')->with('tl_check',$message)->header('Cache-Control','no-store');
    }
}
