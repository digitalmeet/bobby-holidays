<?php

namespace App\Policies;

use App\Models\Traveller;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class TravellerPolicy
{
    use ChecksModulePermissions;

    /**
     * Determine whether the user can view any travellers.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'travellers');
    }

    /**
     * Determine whether the user can view the traveller.
     */
    public function view(User $user, Traveller $traveller): bool
    {
        return $this->canPerform($user, 'view', 'travellers');
    }

    /**
     * Determine whether the user can create travellers.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'travellers');
    }

    /**
     * Determine whether the user can update the traveller.
     */
    public function update(User $user, Traveller $traveller): bool
    {
        return $this->canPerform($user, 'edit', 'travellers');
    }

    /**
     * Determine whether the user can delete the traveller.
     */
    public function delete(User $user, Traveller $traveller): bool
    {
        return $this->canPerform($user, 'delete', 'travellers');
    }

    /**
     * Determine whether the user can restore the traveller.
     */
    public function restore(User $user, Traveller $traveller): bool
    {
        return $this->canPerform($user, 'restore', 'travellers');
    }
}