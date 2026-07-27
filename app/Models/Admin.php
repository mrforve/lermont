<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Concerns\LogsAdminActivity;

class Admin extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use Notifiable;
    use LogsAdminActivity;

    public const ROLE_SUPER_ADMIN = 'super_admin';
    public const ROLE_CONTENT_MANAGER = 'content_manager';
    public const ROLE_MANAGER = 'manager';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
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
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'admin'
            && $this->is_active;
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isContentManager(): bool
    {
        return $this->role === self::ROLE_CONTENT_MANAGER;
    }

    public function isManager(): bool
    {
        return $this->role === self::ROLE_MANAGER;
    }

    public function canManageContent(): bool
    {
        return $this->isSuperAdmin()
            || $this->isContentManager();
    }

    public function canManageRooms(): bool
    {
        return $this->isSuperAdmin()
            || $this->isContentManager()
            || $this->isManager();
    }

    public function canManageSiteUsers(): bool
    {
        return $this->isSuperAdmin()
            || $this->isManager();
    }

    public function canManageAdmins(): bool
    {
        return $this->isSuperAdmin();
    }
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->useLogName('Admin')
            ->logOnly([
                'name',
                'email',
                'role',
                'is_active',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}