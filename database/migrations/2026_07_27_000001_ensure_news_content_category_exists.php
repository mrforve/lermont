<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (! DB::table('content_categories')->where('slug', 'news')->exists()) {
            DB::table('content_categories')->insert([
                'name' => 'Новости',
                'slug' => 'news',
                'description' => 'Новости и события отеля',
                'is_active' => true,
                'sort_order' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        // Категория не удаляется при откате, чтобы не потерять связанные новости.
    }
};
