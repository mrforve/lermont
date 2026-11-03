<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $this->replace(false);
    }

    public function down(): void
    {
        $this->replace(true);
    }

    private function replace(bool $reverse): void
    {
        $replacements = [
            'pravila-prozhivaniya-i-predostavleniya-uslug-1.pdf' => 'pravila-prozhivaniya.pdf',
            'soglasie-na-obrabotku-1.pdf' => 'soglasie-na-obrabotku-personalnyh-dannyh.pdf',
            'personalnye-dannye.pdf' => 'politika-konfidencialnosti.pdf',
            'politika-po-obrabotke-personalnyh-dannyh.pdf' => 'politika-obrabotki-personalnyh-dannyh.pdf',
            '>Персональные данные<' => '>Политика конфиденциальности<',
            'Открыть: Персональные данные' => 'Открыть: Политика конфиденциальности',
            'Скачать: Персональные данные' => 'Скачать: Политика конфиденциальности',
            'aria-label="Персональные данные"' => 'aria-label="Политика конфиденциальности"'
        ];
        if ($reverse) {
            $replacements = array_flip($replacements);
        }
        $page = DB::table('pages')->where('slug', 'ugolok-potrebitelya')->first();
        if (! $page || ! $page->blocks) {
            return;
        }
        $blocks = json_decode($page->blocks, true, 512, JSON_THROW_ON_ERROR);
        array_walk_recursive($blocks, function (&$value) use ($replacements) {
            if (is_string($value)) {
                $value = strtr($value, $replacements);
            }
        });
        DB::table('pages')->where('id', $page->id)->update([
            'blocks' => json_encode($blocks, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR),
            'updated_at' => now(),
        ]);
    }
};
