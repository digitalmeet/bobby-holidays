<?php

namespace App\Policies;

use App\Models\Quotation;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class QuotationPolicy
{
    use ChecksModulePermissions;

    /**
     * Determine whether the user can view any quotations.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'quotations');
    }

    /**
     * Determine whether the user can view the quotation.
     */
    public function view(User $user, Quotation $quotation): bool
    {
        return $this->canPerform($user, 'view', 'quotations');
    }

    /**
     * Determine whether the user can create quotations.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'quotations');
    }

    /**
     * Determine whether the user can update the quotation.
     */
    public function update(User $user, Quotation $quotation): bool
    {
        return $this->canPerform($user, 'edit', 'quotations');
    }

    /**
     * Determine whether the user can delete the quotation.
     */
    public function delete(User $user, Quotation $quotation): bool
    {
        return $this->canPerform($user, 'delete', 'quotations');
    }

    /**
     * Determine whether the user can restore the quotation.
     */
    public function restore(User $user, Quotation $quotation): bool
    {
        return $this->canPerform($user, 'restore', 'quotations');
    }

    /**
     * Determine whether the user can permanently delete the quotation.
     */
    public function forceDelete(User $user, Quotation $quotation): bool
    {
        return $this->canPerform($user, 'force_delete', 'quotations');
    }

    /**
     * Determine whether the user can send the quotation.
     */
    public function send(User $user, Quotation $quotation): bool
    {
        return $this->canPerform($user, 'send', 'quotations');
    }

    /**
     * Determine whether the user can download quotation PDF.
     */
    public function downloadPdf(User $user, Quotation $quotation): bool
    {
        return $this->canPerform($user, 'download_pdf', 'quotations');
    }

    /**
     * Determine whether the user can create a new version of the quotation.
     */
    public function createVersion(User $user, Quotation $quotation): bool
    {
        return $this->canPerform($user, 'create_version', 'quotations');
    }

    /**
     * Determine whether the user can accept the quotation.
     */
    public function accept(User $user, Quotation $quotation): bool
    {
        return $this->canPerform($user, 'accept', 'quotations');
    }

    /**
     * Determine whether the user can reject the quotation.
     */
    public function reject(User $user, Quotation $quotation): bool
    {
        return $this->canPerform($user, 'reject', 'quotations');
    }

    /**
     * Determine whether the user can request changes to the quotation.
     */
    public function requestChanges(User $user, Quotation $quotation): bool
    {
        return $this->canPerform($user, 'request_changes', 'quotations');
    }

    /**
     * Determine whether the user can copy the public link of the quotation.
     */
    public function copyPublicLink(User $user, Quotation $quotation): bool
    {
        return $this->canPerform($user, 'copy_public_link', 'quotations');
    }
}