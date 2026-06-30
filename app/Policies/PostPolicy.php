<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Policies\Concerns\ChecksModulePermissions;

class PostPolicy
{
    use ChecksModulePermissions;

    /**
     * Determine whether the user can view any posts.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform($user, 'view', 'posts');
    }

    /**
     * Determine whether the user can view the post.
     */
    public function view(User $user, Post $post): bool
    {
        return $this->canPerform($user, 'view', 'posts');
    }

    /**
     * Determine whether the user can create posts.
     */
    public function create(User $user): bool
    {
        return $this->canPerform($user, 'create', 'posts');
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post): bool
    {
        return $this->canPerform($user, 'edit', 'posts');
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post): bool
    {
        return $this->canPerform($user, 'delete', 'posts');
    }

    /**
     * Determine whether the user can restore the post.
     */
    public function restore(User $user, Post $post): bool
    {
        return $this->canPerform($user, 'restore', 'posts');
    }

    /**
     * Determine whether the user can permanently delete the post.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $this->canPerform($user, 'force_delete', 'posts');
    }

    /**
     * Determine whether the user can publish the post.
     */
    public function publish(User $user, Post $post): bool
    {
        return $this->canPerform($user, 'publish', 'posts');
    }
}