<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\LogsAdminActivity;

class SiteSetting extends Model
{
    protected $hidden = ['max_bot_token', 'travelline_client_secret', 'travelline_api_key'];
    protected function casts(): array
    {
        return ['travelline_client_secret' => 'encrypted', 'travelline_api_key' => 'encrypted', 'travelline_api_enabled' => 'boolean', 'max_bot_token' => 'encrypted', 'max_notifications_enabled' => 'boolean'];
    }

    protected $fillable = [
        'max_bot_token',
        'max_chat_id',
        'max_notifications_enabled',
        'site_name',
        'logo',
        'logo_dark',
        'favicon',
        'phone',
        'phone_secondary',
        'email',
        'address',
        'working_hours',
        'telegram_url',
        'whatsapp_url',
        'vk_url',
        'youtube_url',
        'travelline_api_enabled',
        'travelline_auth_mode',
        'travelline_client_id',
        'travelline_client_secret',
        'travelline_api_key',
        'travelline_hotel_id',
        'travelline_booking_url',
        'footer_text',
        'company_name',
        'company_inn',
        'company_ogrn',
        'seo_title',
        'seo_description',
    ];
}