<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('room_types', function (Blueprint $table) {
            $table->string('short_name')->nullable()->after('name');
        });

        $names = [
                        'bolsoi-standart-s-balkonom-na-1-m-etaze' => 'Большой стандарт',
                        'standart-pervoi-kategorii-s-balkonom' => 'Стандарт 1 кат',
                        'ulucsennyi-standart-s-balkonom' => 'Улучшенный стандарт',
                        'dzunior-siuit-s-balkonom' => 'Джуниор сюит',
                        'femili-studiia-bez-balkona' => 'Фемили без балкона',
                        'femili-studiia-s-balkonom-na-1m-etaze' => 'Фемили с балконом',
        ];
        foreach ($names as $slug => $name) {
            DB::table('room_types')->where('slug', $slug)
                ->update(['short_name' => $name]);
        }
    }

    public function down(): void
    {
        Schema::table('room_types', function (Blueprint $table) {
            $table->dropColumn('short_name');
        });
    }
};
