<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\SiteSetting;

class SiteSettingPolicy
{
    public function viewAny(Admin $admin): bool
    {
        return $admin->canManageContent();
    }

    public function view(Admin $admin, SiteSetting $siteSetting): bool
    {
        return $admin->canManageContent();
    }

    public function create(Admin $admin): bool
    {
        return $admin->canManageContent();
    }

    public function update(Admin $admin, SiteSetting $siteSetting): bool
    {
        return $admin->canManageContent();
    }

    public function delete(Admin $admin, SiteSetting $siteSetting): bool
    {
        return $admin->isSuperAdmin();
    }

    public function deleteAny(Admin $admin): bool
    {
        return false;
    }
}