<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\LogsAdminActivity;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'menu_title',
        'content',
        'blocks',
        'template',
        'seo_title',
        'seo_description',
        'show_in_menu',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'blocks' => 'array',
            'show_in_menu' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}