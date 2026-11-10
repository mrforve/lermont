<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration {
 public function up(): void {
  Schema::create('room_views',function(Blueprint $t){$t->id();$t->string('key')->unique();$t->string('name');$t->unsignedInteger('sort_order')->default(0);$t->boolean('is_active')->default(true);$t->timestamps();});
  foreach(\App\Models\RoomType::VIEW_OPTIONS as $key=>$name) DB::table('room_views')->insert(['key'=>$key,'name'=>$name,'sort_order'=>DB::table('room_views')->count()*10,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()]);
 }
 public function down(): void {Schema::dropIfExists('room_views');}
};
