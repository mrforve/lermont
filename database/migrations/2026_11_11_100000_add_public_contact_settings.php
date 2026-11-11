<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {Schema::table('site_settings',function(Blueprint $t){$t->text('max_chat_url')->nullable();$t->text('max_channel_url')->nullable();$t->text('ok_url')->nullable();$t->text('rutube_url')->nullable();$t->text('dzen_url')->nullable();$t->text('tripadvisor_url')->nullable();$t->text('google_maps_url')->nullable();$t->text('yandex_maps_url')->nullable();$t->text('gis_maps_url')->nullable();$t->text('map_embed_url')->nullable();$t->json('footer_links')->nullable();$t->json('footer_legal_links')->nullable();});}
 public function down(): void {Schema::table('site_settings',fn(Blueprint $t)=>$t->dropColumn(["max_chat_url", "max_channel_url", "ok_url", "rutube_url", "dzen_url", "tripadvisor_url", "google_maps_url", "yandex_maps_url", "gis_maps_url", "map_embed_url", "footer_links", "footer_legal_links"]));}
};
