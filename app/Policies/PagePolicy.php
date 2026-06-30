<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class PagePolicy
{
    use ChecksModulePermissions;

    /**
     * Determine whether the user can view any pages.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'pages');
    }

    /**
     * Determine whether the user can view the page.
     */
    public function view(User $user, Page $page): bool
    {
        return $this->canPerform($user, 'view', 'pages');
    }

    /**
     * Determine whether the user can create pages.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'pages');
    }

    /**
     * Determine whether the user can update the page.
     */
    public function update(User $user, Page $page): bool
    {
        return $this->canPerform($user, 'edit', 'pages');
    }

    /**
     * Determine whether the user can delete the page.
     */
    public function delete(User $user, Page $page): bool
    {
        return $this->canPerform($user, 'delete', 'pages');
    }

    /**
     * Determine whether the user can restore the page.
     */
    public function restore(User $user, Page $page): bool
    {
        return $this->canPerform($user, 'restore', 'pages');
    }

    /**
     * Determine whether the user can permanently delete the page.
     */
    public function forceDelete(User $user, Page $page): bool
    {
        return $this->canPerform($user, 'force_delete', 'pages');
    }

    /**
     * Determine whether the user can publish the page.
     */
    public function publish(User $user, Page $page): bool
    {
        return $this->canPerform($user, 'publish', 'pages');
    }
}