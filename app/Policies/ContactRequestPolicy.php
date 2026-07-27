<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\ContactRequest;

class ContactRequestPolicy
{
    public function viewAny(Admin $admin): bool
    {
        return $admin->isSuperAdmin()
            || $admin->isManager();
    }

    public function view(Admin $admin, ContactRequest $contactRequest): bool
    {
        return $admin->isSuperAdmin()
            || $admin->isManager();
    }

    public function create(Admin $admin): bool
    {
        return false;
    }

    public function update(Admin $admin, ContactRequest $contactRequest): bool
    {
        return $admin->isSuperAdmin()
            || $admin->isManager();
    }

    public function delete(Admin $admin, ContactRequest $contactRequest): bool
    {
        return $admin->isSuperAdmin();
    }

    public function deleteAny(Admin $admin): bool
    {
        return false;
    }
}