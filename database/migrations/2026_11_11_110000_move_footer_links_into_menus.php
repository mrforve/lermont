<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
return new class extends Migration {
 public function up(): void {
  DB::transaction(function () {
   $settings=DB::table('site_settings')->where('id',1)->first();if(!$settings)return;
   foreach(['footer_links'=>'footer','footer_legal_links'=>'footer_legal'] as $field=>$location){
    $links=json_decode($settings->{$field} ?? '[]',true) ?? [];
    foreach($links as $order=>$link){
     if(empty($link['label']) || empty($link['url']))continue;
     if(DB::table('menu_items')->where('location',$location)->whereNull('parent_id')->where('url',$link['url'])->exists())continue;
     DB::table('menu_items')->insert(['parent_id'=>null,'page_id'=>null,'title'=>$link['label'],'location'=>$location,'url'=>$link['url'],'target'=>!empty($link['new_tab'])?'_blank':'_self','sort_order'=>$order*10,'is_active'=>true,'created_at'=>now(),'updated_at'=>now()]);
    }
   }
  });
 }
 public function down(): void {
  // Do not delete editable menu content or restore stale settings on rollback.
 }
};
