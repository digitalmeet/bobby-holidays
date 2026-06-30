<?php

namespace App\Policies;

use App\Models\Tour;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class TourPolicy
{
    use ChecksModulePermissions;

    /**
     * Determine whether the user can view any tours.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'tours');
    }

    /**
     * Determine whether the user can view the tour.
     */
    public function view(User $user, Tour $tour): bool
    {
        return $this->canPerform($user, 'view', 'tours');
    }

    /**
     * Determine whether the user can create tours.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'tours');
    }

    /**
     * Determine whether the user can update the tour.
     */
    public function update(User $user, Tour $tour): bool
    {
        return $this->canPerform($user, 'edit', 'tours');
    }

    /**
     * Determine whether the user can delete the tour.
     */
    public function delete(User $user, Tour $tour): bool
    {
        return $this->canPerform($user, 'delete', 'tours');
    }

    /**
     * Determine whether the user can restore the tour.
     */
    public function restore(User $user, Tour $tour): bool
    {
        return $this->canPerform($user, 'restore', 'tours');
    }

    /**
     * Determine whether the user can permanently delete the tour.
     */
    public function forceDelete(User $user, Tour $tour): bool
    {
        return $this->canPerform($user, 'force_delete', 'tours');
    }

    /**
     * Determine whether the user can duplicate the tour.
     */
    public function duplicate(User $user, Tour $tour): bool
    {
        return $this->canPerform($user, 'duplicate', 'tours');
    }

    /**
     * Determine whether the user can publish the tour.
     */
    public function publish(User $user, Tour $tour): bool
    {
        return $this->canPerform($user, 'publish', 'tours');
    }
}