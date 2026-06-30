<?php

namespace App\Policies;

use App\Models\Faq;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class FaqPolicy
{
    use ChecksModulePermissions;

    /**
     * Determine whether the user can view any faqs.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'faqs');
    }

    /**
     * Determine whether the user can view the faq.
     */
    public function view(User $user, Faq $faq): bool
    {
        return $this->canPerform($user, 'view', 'faqs');
    }

    /**
     * Determine whether the user can create faqs.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'faqs');
    }

    /**
     * Determine whether the user can update the faq.
     */
    public function update(User $user, Faq $faq): bool
    {
        return $this->canPerform($user, 'edit', 'faqs');
    }

    /**
     * Determine whether the user can delete the faq.
     */
    public function delete(User $user, Faq $faq): bool
    {
        return $this->canPerform($user, 'delete', 'faqs');
    }

    /**
     * Determine whether the user can restore the faq.
     */
    public function restore(User $user, Faq $faq): bool
    {
        return $this->canPerform($user, 'restore', 'faqs');
    }

    /**
     * Determine whether the user can permanently delete the faq.
     */
    public function forceDelete(User $user, Faq $faq): bool
    {
        return $this->canPerform($user, 'force_delete', 'faqs');
    }
}