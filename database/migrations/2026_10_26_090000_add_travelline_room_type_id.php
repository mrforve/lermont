<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('room_types', function (Blueprint $table): void {
            $table->unsignedInteger('travelline_room_type_id')->nullable();
        });

        // Category IDs copied from the booking links on hotel-lermont.ru.
        $categories = [
            'bolsoi-standart-s-balkonom-na-1-m-etaze' => 90449,
            'standart-pervoi-kategorii-s-balkonom' => 56609,
            'ulucsennyi-standart-s-balkonom' => 56610,
            'dzunior-siuit-s-balkonom' => 56611,
            'femili-studiia-bez-balkona' => 56949,
            'femili-studiia-s-balkonom-na-1m-etaze' => 56612,
        ];

        foreach ($categories as $slug => $id) {
            DB::table('room_types')->where('slug', $slug)->update(['travelline_room_type_id' => $id]);
        }
    }

    public function down(): void
    {
        Schema::table('room_types', function (Blueprint $table): void {
            $table->dropColumn('travelline_room_type_id');
        });
    }
};
