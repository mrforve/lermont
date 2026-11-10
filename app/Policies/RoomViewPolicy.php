<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\RoomView;

class RoomViewPolicy
{
    public function viewAny(Admin $admin): bool
    {
        return $admin->canManageRooms();
    }

    public function view(Admin $admin, RoomView $roomView): bool
    {
        return $admin->canManageRooms();
    }

    public function create(Admin $admin): bool
    {
        return $admin->canManageRooms();
    }

    public function update(Admin $admin, RoomView $roomView): bool
    {
        return $admin->canManageRooms();
    }

    public function delete(Admin $admin, RoomView $roomView): bool
    {
        return $admin->canManageRooms() && !\App\Models\RoomType::whereJsonContains('room_views', $roomView->key)->exists();
    }

    public function deleteAny(Admin $admin): bool
    {
        return $admin->canManageRooms();
    }
    public function reorder(Admin $admin): bool
    {
        return $admin->canManageRooms();
    }
}