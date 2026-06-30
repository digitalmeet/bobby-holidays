<?php

namespace App\Policies;

use App\Models\QuotationItem;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class QuotationItemPolicy
{
    use ChecksModulePermissions;

    /**
     * Get the module name for quotation items.
     */
    protected function getModuleName(): string
    {
        return 'quotation_items';
    }

    /**
     * Determine whether the user can view any quotation items.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'quotation_items');
    }

    /**
     * Determine whether the user can view the quotation item.
     */
    public function view(User $user, QuotationItem $quotationItem): bool
    {
        return $this->canPerform($user, 'view', 'quotation_items');
    }

    /**
     * Determine whether the user can create quotation items.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'quotation_items');
    }

    /**
     * Determine whether the user can update the quotation item.
     */
    public function update(User $user, QuotationItem $quotationItem): bool
    {
        return $this->canPerform($user, 'edit', 'quotation_items');
    }

    /**
     * Determine whether the user can delete the quotation item.
     */
    public function delete(User $user, QuotationItem $quotationItem): bool
    {
        return $this->canPerform($user, 'delete', 'quotation_items');
    }

    /**
     * Determine whether the user can restore the quotation item.
     */
    public function restore(User $user, QuotationItem $quotationItem): bool
    {
        return $this->canPerform($user, 'restore', 'quotation_items');
    }
}