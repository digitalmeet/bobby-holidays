<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class PaymentPolicy
{
    use ChecksModulePermissions;

    /**
     * Determine whether the user can view any payments.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'payments');
    }

    /**
     * Determine whether the user can view the payment.
     */
    public function view(User $user, Payment $payment): bool
    {
        return $this->canPerform($user, 'view', 'payments');
    }

    /**
     * Determine whether the user can create payments.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'payments');
    }

    /**
     * Determine whether the user can update the payment.
     */
    public function update(User $user, Payment $payment): bool
    {
        return $this->canPerform($user, 'edit', 'payments');
    }

    /**
     * Determine whether the user can delete the payment.
     */
    public function delete(User $user, Payment $payment): bool
    {
        return $this->canPerform($user, 'delete', 'payments');
    }

    /**
     * Determine whether the user can restore the payment.
     */
    public function restore(User $user, Payment $payment): bool
    {
        return $this->canPerform($user, 'restore', 'payments');
    }

    /**
     * Determine whether the user can permanently delete the payment.
     */
    public function forceDelete(User $user, Payment $payment): bool
    {
        return $this->canPerform($user, 'force_delete', 'payments');
    }

    /**
     * Determine whether the user can refund the payment.
     */
    public function refund(User $user, Payment $payment): bool
    {
        return $this->canPerform($user, 'refund', 'payments');
    }
}