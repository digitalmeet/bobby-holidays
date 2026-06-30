<?php

namespace App\Policies;

use App\Models\TourPricing;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class TourPricingPolicy
{
    use ChecksModulePermissions;

    /**
     * Get the module name for tour pricing.
     */
    protected function getModuleName(): string
    {
        return 'tour_pricing';
    }

    /**
     * Determine whether the user can view any tour pricing.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'tour_pricing');
    }

    /**
     * Determine whether the user can view the tour pricing.
     */
    public function view(User $user, TourPricing $tourPricing): bool
    {
        return $this->canPerform($user, 'view', 'tour_pricing');
    }

    /**
     * Determine whether the user can create tour pricing.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'tour_pricing');
    }

    /**
     * Determine whether the user can update the tour pricing.
     */
    public function update(User $user, TourPricing $tourPricing): bool
    {
        return $this->canPerform($user, 'edit', 'tour_pricing');
    }

    /**
     * Determine whether the user can delete the tour pricing.
     */
    public function delete(User $user, TourPricing $tourPricing): bool
    {
        return $this->canPerform($user, 'delete', 'tour_pricing');
    }

    /**
     * Determine whether the user can restore the tour pricing.
     */
    public function restore(User $user, TourPricing $tourPricing): bool
    {
        return $this->canPerform($user, 'restore', 'tour_pricing');
    }
}