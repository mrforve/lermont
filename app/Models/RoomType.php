<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Concerns\LogsAdminActivity;

class RoomType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'main_image',
        'capacity',
        'extra_capacity',
        'area',
        'base_price',
        'travelline_room_type_id',
        'sort_order',
        'is_active',
        'seo_title',
        'seo_description',
    ];

    protected function casts(): array
    {
        return [
            'capacity' => 'integer',
            'extra_capacity' => 'integer',
            'area' => 'integer',
            'base_price' => 'decimal:2',
            'travelline_room_type_id' => 'integer',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function getBookingUrlAttribute(): string
    {
        return route('booking', $this->travelline_room_type_id
            ? ['room-type' => $this->travelline_room_type_id]
            : []);
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class)
            ->withTimestamps();
    }
    public function images(): HasMany
    {
        return $this->hasMany(RoomTypeImage::class)
            ->orderBy('sort_order');
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}