<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::table('site_settings',function(Blueprint $t){$t->text('max_bot_token')->nullable();$t->string('max_chat_id',30)->nullable();$t->boolean('max_notifications_enabled')->default(false);});
  Schema::table('contact_requests',function(Blueprint $t){$t->timestamp('max_notified_at')->nullable();$t->string('max_message_id')->nullable();});
 }
 public function down(): void {
  Schema::table('contact_requests',fn(Blueprint $t)=>$t->dropColumn(['max_notified_at','max_message_id']));
  Schema::table('site_settings',fn(Blueprint $t)=>$t->dropColumn(['max_bot_token','max_chat_id','max_notifications_enabled']));
 }
};
