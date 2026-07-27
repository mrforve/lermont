<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_name')->default('Lermont');
            $table->string('logo')->nullable();
            $table->string('logo_dark')->nullable();
            $table->string('favicon')->nullable();

            $table->string('phone')->nullable();
            $table->string('phone_secondary')->nullable();
            $table->string('email')->nullable();

            $table->text('address')->nullable();
            $table->string('working_hours')->nullable();

            $table->string('telegram_url')->nullable();
            $table->string('whatsapp_url')->nullable();
            $table->string('vk_url')->nullable();
            $table->string('youtube_url')->nullable();

            $table->string('travelline_hotel_id')->nullable();
            $table->string('travelline_booking_url')->nullable();

            $table->text('footer_text')->nullable();

            $table->string('company_name')->nullable();
            $table->string('company_inn')->nullable();
            $table->string('company_ogrn')->nullable();

            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};