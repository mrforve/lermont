<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {Schema::table('site_settings',function(Blueprint $t){$t->boolean('travelline_api_enabled')->default(false);$t->string('travelline_auth_mode')->default('oauth');$t->string('travelline_client_id')->nullable();$t->text('travelline_client_secret')->nullable();$t->text('travelline_api_key')->nullable();});}
 public function down(): void {Schema::table('site_settings',fn(Blueprint $t)=>$t->dropColumn(['travelline_api_enabled','travelline_auth_mode','travelline_client_id','travelline_client_secret','travelline_api_key']));}
};
