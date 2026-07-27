<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Slide;

class SlidePolicy
{
    public function viewAny(Admin $admin): bool
    {
        return $admin->canManageContent();
    }

    public function view(Admin $admin, Slide $slide): bool
    {
        return $admin->canManageContent();
    }

    public function create(Admin $admin): bool
    {
        return $admin->canManageContent();
    }

    public function update(Admin $admin, Slide $slide): bool
    {
        return $admin->canManageContent();
    }

    public function delete(Admin $admin, Slide $slide): bool
    {
        return $admin->canManageContent();
    }

    public function deleteAny(Admin $admin): bool
    {
        return $admin->canManageContent();
    }
    public function reorder(Admin $admin): bool
    {
        return $admin->canManageContent();
    }
}