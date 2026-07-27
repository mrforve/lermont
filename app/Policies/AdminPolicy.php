<?php

namespace App\Policies;

use App\Models\Admin;

class AdminPolicy
{
    public function viewAny(Admin $admin): bool
    {
        return $admin->canManageAdmins();
    }

    public function view(Admin $admin, Admin $record): bool
    {
        return $admin->canManageAdmins();
    }

    public function create(Admin $admin): bool
    {
        return $admin->canManageAdmins();
    }

    public function update(Admin $admin, Admin $record): bool
    {
        return $admin->canManageAdmins();
    }

    public function delete(Admin $admin, Admin $record): bool
    {
        return $admin->canManageAdmins()
            && $admin->id !== $record->id;
    }

    public function deleteAny(Admin $admin): bool
    {
        return false;
    }
}