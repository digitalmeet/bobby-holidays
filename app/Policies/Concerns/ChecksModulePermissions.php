<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait ChecksModulePermissions
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): ?bool
    {
        // Super admin bypasses all policy checks
        if ($user->isSuperAdmin()) {
            return true;
        }

        return null; // Continue with normal authorization
    }

    /**
     * Check if user can perform a specific action on a module.
     */
    public function canPerform(User $user, string $action, string $module): bool
    {
        // Super admin bypass is already handled in before() method
        $permission = "{$action}_{$module}";
        
        return $user->can($permission);
    }

    /**
     * Get the module name from the policy class name.
     * Override this method in policies if the module name differs from the class name.
     */
    protected function getModuleName(): string
    {
        // Extract module name from policy class name
        // e.g., DestinationPolicy -> destinations
        $className = class_basename(static::class);
        $modelName = str_replace('Policy', '', $className);
        
        return strtolower($modelName) . 's'; // Convert to plural
    }
}