<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Concerns\LogsAdminActivity;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    use LogsAdminActivity;

    protected $fillable = [
        'name',
        'last_name',
        'middle_name',
        'phone',
        'email',
        'email_verified_at',
        'password',
        'is_active',
        'consent_at',
        'consent_text_version',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'consent_at' => 'datetime',
        ];
    }
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->useLogName('User')
            ->logOnly([
                'name',
                'last_name',
                'middle_name',
                'phone',
                'email',
                'is_active',
                'email_verified_at',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
    public function contactRequests(): HasMany
    {
        return $this->hasMany(ContactRequest::class)
            ->latest();
    }
}