<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $page = DB::table('pages')->where('slug', 'ugolok-potrebitelya')->first();

        if (! $page || ! $page->blocks) {
            return;
        }

        $blocks = json_decode($page->blocks, true, 512, JSON_THROW_ON_ERROR);
        $pattern = <<<'REGEX'
~<link\b[^>]*\bhref=["'](?:https?://[^/"']+)?/css/consumer-corner\.css(?:\?[^"']*)?["'][^>]*>\s*~i
REGEX;

        foreach ($blocks as &$block) {
            if (($block['type'] ?? null) === 'html' && isset($block['data']['html'])) {
                $block['data']['html'] = preg_replace($pattern, '', $block['data']['html']);
            }
        }
        unset($block);

        DB::table('pages')->where('id', $page->id)->update([
            'blocks' => json_encode($blocks, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR),
        ]);
    }

    public function down(): void
    {
        // The content is unchanged; styles continue to load through the common CSS entry.
    }
};
