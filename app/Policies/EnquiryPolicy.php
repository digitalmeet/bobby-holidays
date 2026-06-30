<?php

namespace App\Policies;

use App\Models\Enquiry;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class EnquiryPolicy
{
    use ChecksModulePermissions;

    /**
     * Determine whether the user can view any enquiries.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'enquiries');
    }

    /**
     * Determine whether the user can view the enquiry.
     */
    public function view(User $user, Enquiry $enquiry): bool
    {
        return $this->canPerform($user, 'view', 'enquiries');
    }

    /**
     * Determine whether the user can create enquiries.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'enquiries');
    }

    /**
     * Determine whether the user can update the enquiry.
     */
    public function update(User $user, Enquiry $enquiry): bool
    {
        return $this->canPerform($user, 'edit', 'enquiries');
    }

    /**
     * Determine whether the user can delete the enquiry.
     */
    public function delete(User $user, Enquiry $enquiry): bool
    {
        return $this->canPerform($user, 'delete', 'enquiries');
    }

    /**
     * Determine whether the user can restore the enquiry.
     */
    public function restore(User $user, Enquiry $enquiry): bool
    {
        return $this->canPerform($user, 'restore', 'enquiries');
    }

    /**
     * Determine whether the user can permanently delete the enquiry.
     */
    public function forceDelete(User $user, Enquiry $enquiry): bool
    {
        return $this->canPerform($user, 'force_delete', 'enquiries');
    }

    /**
     * Determine whether the user can assign the enquiry.
     */
    public function assign(User $user, Enquiry $enquiry): bool
    {
        return $this->canPerform($user, 'assign', 'enquiries');
    }

    /**
     * Determine whether the user can mark enquiry as contacted.
     */
    public function markContacted(User $user, Enquiry $enquiry): bool
    {
        return $this->canPerform($user, 'mark_contacted', 'enquiries');
    }

    /**
     * Determine whether the user can mark enquiry as lost.
     */
    public function markLost(User $user, Enquiry $enquiry): bool
    {
        return $this->canPerform($user, 'mark_lost', 'enquiries');
    }

    /**
     * Determine whether the user can convert the enquiry.
     */
    public function convert(User $user, Enquiry $enquiry): bool
    {
        return $this->canPerform($user, 'convert', 'enquiries');
    }
}