<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\RoomType;

class RoomTypePolicy
{
    public function viewAny(Admin $admin): bool
    {
        return $admin->canManageRooms();
    }

    public function view(Admin $admin, RoomType $roomType): bool
    {
        return $admin->canManageRooms();
    }

    public function create(Admin $admin): bool
    {
        return $admin->canManageRooms();
    }

    public function update(Admin $admin, RoomType $roomType): bool
    {
        return $admin->canManageRooms();
    }

    public function delete(Admin $admin, RoomType $roomType): bool
    {
        return $admin->canManageRooms();
    }

    public function deleteAny(Admin $admin): bool
    {
        return $admin->canManageRooms();
    }
}