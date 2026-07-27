<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Room;

class RoomPolicy
{
    public function viewAny(Admin $admin): bool
    {
        return $admin->canManageRooms();
    }

    public function view(Admin $admin, Room $room): bool
    {
        return $admin->canManageRooms();
    }

    public function create(Admin $admin): bool
    {
        return $admin->canManageRooms();
    }

    public function update(Admin $admin, Room $room): bool
    {
        return $admin->canManageRooms();
    }

    public function delete(Admin $admin, Room $room): bool
    {
        return $admin->canManageRooms();
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