<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Concerns\LogsAdminActivity;

class MenuItem extends Model
{
    protected $fillable = [
        'parent_id',
        'page_id',
        'title',
        'location',
        'url',
        'target',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')
            ->orderBy('sort_order');
    }
    public function getResolvedUrlAttribute(): string
    {
        if ($this->page) {
            return $this->page->template === 'home'
                ? route('home')
                : route('pages.show', $this->page->slug);
        }

        return $this->url ?: '#';
    }
}