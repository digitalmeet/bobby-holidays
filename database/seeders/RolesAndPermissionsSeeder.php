<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🚀 Starting Roles and Permissions Seeder...');

        // Clear Spatie permission cache
        $this->command->info('🧹 Clearing permission cache...');
        Artisan::call('permission:cache-reset');

        // Get modules configuration
        $modules = config('admin-modules');
        if (empty($modules)) {
            $this->command->error('❌ No modules found in config/admin-modules.php');
            return;
        }

        // Remove role_permissions and admin_access_roles from modules array
        $adminModules = collect($modules)->except(['role_permissions', 'admin_access_roles']);

        // Create permissions dynamically
        $this->command->info('📋 Creating permissions from modules...');
        $this->createPermissionsFromModules($adminModules->toArray());

        // Create roles
        $this->command->info('👥 Creating roles...');
        $this->createRoles();

        // Assign permissions to roles
        $this->command->info('🔗 Assigning permissions to roles...');
        $this->assignPermissionsToRoles();

        // Clear cache again after seeding
        $this->command->info('🧹 Clearing permission cache after seeding...');
        Artisan::call('permission:cache-reset');

        $this->command->info('✅ Roles and Permissions Seeder completed successfully!');
        $this->displaySummary();
    }

    /**
     * Create permissions dynamically from modules configuration
     */
    private function createPermissionsFromModules(array $modules): void
    {
        $permissionCount = 0;

        foreach ($modules as $moduleKey => $module) {
            if (!isset($module['actions']) || !is_array($module['actions'])) {
                continue;
            }

            foreach ($module['actions'] as $action => $description) {
                $permissionName = "{$action}_{$moduleKey}";
                
                Permission::firstOrCreate(
                    ['name' => $permissionName],
                    ['guard_name' => 'web']
                );

                $permissionCount++;
                $this->command->info("  ✓ Permission created: {$permissionName}");
            }
        }

        $this->command->info("📋 Total permissions created: {$permissionCount}");
    }

    /**
     * Create roles
     */
    private function createRoles(): void
    {
        $rolePermissions = config('admin-modules.role_permissions', []);
        
        foreach (array_keys($rolePermissions) as $roleName) {
            $role = Role::firstOrCreate(
                ['name' => $roleName],
                ['guard_name' => 'web']
            );

            $this->command->info("  ✓ Role created: {$roleName}");
        }
    }

    /**
     * Assign permissions to roles based on configuration
     */
    private function assignPermissionsToRoles(): void
    {
        $rolePermissions = config('admin-modules.role_permissions', []);
        $modules = config('admin-modules');

        foreach ($rolePermissions as $roleName => $moduleActions) {
            $role = Role::where('name', $roleName)->first();
            
            if (!$role) {
                $this->command->error("  ❌ Role not found: {$roleName}");
                continue;
            }

            // Super admin gets all permissions
            if ($moduleActions === 'all') {
                $allPermissions = $this->getAllPermissionNames($modules);
                $role->syncPermissions($allPermissions);
                $this->command->info("  ✓ Assigned ALL permissions to: {$roleName} (" . count($allPermissions) . " permissions)");
                continue;
            }

            // Other roles get specific permissions
            if (is_array($moduleActions)) {
                $permissionNames = $this->permissionNamesForModules($moduleActions);
                $role->syncPermissions($permissionNames);
                $this->command->info("  ✓ Assigned permissions to: {$roleName} (" . count($permissionNames) . " permissions)");
            }
        }
    }

    /**
     * Get permission names for specific module actions
     */
    private function permissionNamesForModules(array $moduleActions): array
    {
        $permissions = [];

        foreach ($moduleActions as $module => $actions) {
            foreach ($actions as $action) {
                $permissions[] = "{$action}_{$module}";
            }
        }

        return $permissions;
    }

    /**
     * Get all permission names from all modules
     */
    private function getAllPermissionNames(array $modules): array
    {
        $permissions = [];
        $adminModules = collect($modules)->except(['role_permissions', 'admin_access_roles']);

        foreach ($adminModules as $moduleKey => $module) {
            if (!isset($module['actions']) || !is_array($module['actions'])) {
                continue;
            }

            foreach (array_keys($module['actions']) as $action) {
                $permissions[] = "{$action}_{$moduleKey}";
            }
        }

        return $permissions;
    }

    /**
     * Display seeding summary
     */
    private function displaySummary(): void
    {
        $this->command->info('');
        $this->command->info('📊 SEEDING SUMMARY:');
        $this->command->info('==========================================');
        
        $permissionCount = Permission::count();
        $roleCount = Role::count();
        
        $this->command->info("Total Permissions: {$permissionCount}");
        $this->command->info("Total Roles: {$roleCount}");
        
        $this->command->info('');
        $this->command->info('🔐 CREATED ROLES:');
        $roles = Role::with('permissions')->get();
        
        foreach ($roles as $role) {
            $permCount = $role->permissions->count();
            $this->command->info("  • {$role->name} ({$permCount} permissions)");
        }
        
        $this->command->info('');
        $this->command->info('🎯 Next Steps:');
        $this->command->info('• Assign roles to users');
        $this->command->info('• Configure Filament resources with permission checks');
        $this->command->info('• Test admin panel access restrictions');
    }
}