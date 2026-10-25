<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Promotion;

class PromotionPolicy
{
    public function viewAny(Admin $user): bool
    {
        return true;
    }

    public function view(Admin $user, Promotion $promotion): bool
    {
        return true;
    }

    public function create(Admin $user): bool
    {
        return true;
    }

    public function update(Admin $user, Promotion $promotion): bool
    {
        return true;
    }

    public function delete(Admin $user, Promotion $promotion): bool
    {
        return true;
    }

    public function deleteAny(Admin $user): bool
    {
        return true;
    }
	
	public function reorder(Admin $user): bool
	{
		return true;
	}

    public function restore(Admin $user, Promotion $promotion): bool
    {
        return true;
    }

    public function restoreAny(Admin $user): bool
    {
        return true;
    }

    public function forceDelete(Admin $user, Promotion $promotion): bool
    {
        return true;
    }

    public function forceDeleteAny(Admin $user): bool
    {
        return true;
    }
}