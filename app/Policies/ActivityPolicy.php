<?php

namespace App\Policies;

use App\Models\Activity;
use App\Models\Admin;

class ActivityPolicy
{
    public function viewAny(Admin $admin): bool
    {
        return $admin->isSuperAdmin();
    }

    public function view(Admin $admin, Activity $activity): bool
    {
        return $admin->isSuperAdmin();
    }

    public function create(Admin $admin): bool
    {
        return false;
    }

    public function update(Admin $admin, Activity $activity): bool
    {
        return false;
    }

    public function delete(Admin $admin, Activity $activity): bool
    {
        return false;
    }

    public function deleteAny(Admin $admin): bool
    {
        return false;
    }

    public function restore(Admin $admin, Activity $activity): bool
    {
        return false;
    }

    public function restoreAny(Admin $admin): bool
    {
        return false;
    }

    public function forceDelete(Admin $admin, Activity $activity): bool
    {
        return false;
    }

    public function forceDeleteAny(Admin $admin): bool
    {
        return false;
    }
}