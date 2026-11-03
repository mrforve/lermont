<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private function images(): array
    {
        return [
            'https://hotel-lermont.ru/wp-content/uploads/2026/08/izobrazhenie-codex-27-avg.-2026-g.-14_50_34.jpg' => '/img/offers/birthday.jpg',
            'https://hotel-lermont.ru/wp-content/uploads/2026/08/izobrazhenie-codex-27-avg.-2026-g.-14_53_39.jpg' => '/img/offers/black-friday-3-plus-1.jpg',
            'https://hotel-lermont.ru/wp-content/uploads/2026/08/exec-f2d827ff-9a58-4edd-a057-02cae5434e0a-1024x683.png' => '/img/offers/newlyweds.png',
            'https://hotel-lermont.ru/wp-content/uploads/2024/10/i-2-1024x806.webp' => '/img/offers/group-rates.webp'
        ];
    }

    public function up(): void
    {
        foreach ($this->images() as $old => $local) {
            $local = rtrim(config('app.url'), '/') . $local;
            DB::table('promotions')->whereIn('legacy_image_url', [
                $old, str_replace('https://hotel-lermont.ru', 'https://dev.hotel-lermont.ru', $old),
            ])->update(['legacy_image_url' => $local]);
        }
    }

    public function down(): void
    {
        foreach ($this->images() as $old => $local) {
            $local = rtrim(config('app.url'), '/') . $local;
            DB::table('promotions')->where('legacy_image_url', $local)
                ->update(['legacy_image_url' => $old]);
        }
    }
};
