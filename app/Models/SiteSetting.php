<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\LogsAdminActivity;

class SiteSetting extends Model
{
    protected $fillable = [
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