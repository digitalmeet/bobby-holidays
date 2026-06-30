<?php

namespace App\Policies;

use App\Models\Banner;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class BannerPolicy
{
    use ChecksModulePermissions;

    /**
     * Determine whether the user can view any banners.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'banners');
    }

    /**
     * Determine whether the user can view the banner.
     */
    public function view(User $user, Banner $banner): bool
    {
        return $this->canPerform($user, 'view', 'banners');
    }

    /**
     * Determine whether the user can create banners.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'banners');
    }

    /**
     * Determine whether the user can update the banner.
     */
    public function update(User $user, Banner $banner): bool
    {
        return $this->canPerform($user, 'edit', 'banners');
    }

    /**
     * Determine whether the user can delete the banner.
     */
    public function delete(User $user, Banner $banner): bool
    {
        return $this->canPerform($user, 'delete', 'banners');
    }

    /**
     * Determine whether the user can restore the banner.
     */
    public function restore(User $user, Banner $banner): bool
    {
        return $this->canPerform($user, 'restore', 'banners');
    }

    /**
     * Determine whether the user can permanently delete the banner.
     */
    public function forceDelete(User $user, Banner $banner): bool
    {
        return $this->canPerform($user, 'force_delete', 'banners');
    }
}