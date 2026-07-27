<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;

class UserPolicy
{
    public function viewAny(Admin $admin): bool
    {
        return $admin->canManageSiteUsers();
    }

    public function view(Admin $admin, User $user): bool
    {
        return $admin->canManageSiteUsers();
    }

    public function create(Admin $admin): bool
    {
        return $admin->canManageSiteUsers();
    }

    public function update(Admin $admin, User $user): bool
    {
        return $admin->canManageSiteUsers();
    }

    public function delete(Admin $admin, User $user): bool
    {
        return $admin->canManageSiteUsers();
    }

    public function deleteAny(Admin $admin): bool
    {
        return $admin->canManageSiteUsers();
    }
}