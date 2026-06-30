<?php

namespace App\Policies;

use App\Models\Destination;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class DestinationPolicy
{
    use ChecksModulePermissions;

    /**
     * Determine whether the user can view any destinations.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'destinations');
    }

    /**
     * Determine whether the user can view the destination.
     */
    public function view(User $user, Destination $destination): bool
    {
        return $this->canPerform($user, 'view', 'destinations');
    }

    /**
     * Determine whether the user can create destinations.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'destinations');
    }

    /**
     * Determine whether the user can update the destination.
     */
    public function update(User $user, Destination $destination): bool
    {
        return $this->canPerform($user, 'edit', 'destinations');
    }

    /**
     * Determine whether the user can delete the destination.
     */
    public function delete(User $user, Destination $destination): bool
    {
        return $this->canPerform($user, 'delete', 'destinations');
    }

    /**
     * Determine whether the user can restore the destination.
     */
    public function restore(User $user, Destination $destination): bool
    {
        return $this->canPerform($user, 'restore', 'destinations');
    }

    /**
     * Determine whether the user can permanently delete the destination.
     */
    public function forceDelete(User $user, Destination $destination): bool
    {
        return $this->canPerform($user, 'force_delete', 'destinations');
    }
}