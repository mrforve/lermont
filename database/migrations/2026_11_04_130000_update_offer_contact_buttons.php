<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const MAX_URL = 'https://max.ru/u/f9LHodD0cOK4G43DwSuPA5VIJa5VpTvBReELJPM9XQC3q5I1UzjmGjBXVVA';

    public function up(): void
    {
        DB::table('promotions')->whereIn('slug', array_keys($this->previousButtons()))->update([
            'button_text' => 'Написать в MAX',
            'button_url' => self::MAX_URL,
        ]);
    }

    public function down(): void
    {
        foreach ($this->previousButtons() as $slug => [$text, $url]) {
            DB::table('promotions')->where('slug', $slug)->where('button_url', self::MAX_URL)
                ->where('button_text', 'Написать в MAX')
                ->update(['button_text' => $text, 'button_url' => $url]);
        }
    }

    private function previousButtons(): array
    {
        return [
            'birthday' => ['Забронировать', '/booking/'],
            'black-friday-3-plus-1' => ['Забронировать номер', '/booking/?be-offer=965144'],
            'newlyweds' => ['Забронировать', '/booking/'],
            'group-rates' => ['Отправить запрос', '/contacts']
        ];
    }
};
