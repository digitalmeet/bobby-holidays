<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class SettingPolicy
{
    use ChecksModulePermissions;

    /**
     * Determine whether the user can view any settings.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'settings');
    }

    /**
     * Determine whether the user can view the setting.
     */
    public function view(User $user, Setting $setting): bool
    {
        return $this->canPerform($user, 'view', 'settings');
    }

    /**
     * Determine whether the user can create settings.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'settings');
    }

    /**
     * Determine whether the user can update the setting.
     */
    public function update(User $user, Setting $setting): bool
    {
        return $this->canPerform($user, 'edit', 'settings');
    }

    /**
     * Determine whether the user can delete the setting.
     */
    public function delete(User $user, Setting $setting): bool
    {
        return $this->canPerform($user, 'delete', 'settings');
    }

    /**
     * Determine whether the user can restore the setting.
     */
    public function restore(User $user, Setting $setting): bool
    {
        return $this->canPerform($user, 'restore', 'settings');
    }

    /**
     * Determine whether the user can permanently delete the setting.
     */
    public function forceDelete(User $user, Setting $setting): bool
    {
        return $this->canPerform($user, 'force_delete', 'settings');
    }
}