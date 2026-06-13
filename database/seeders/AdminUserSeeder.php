<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@uniworldholidays.com'],
            [
                'name' => 'Super Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]
        );

        // Assign super_admin role if it exists
        $superAdminRole = Role::where('name', 'super_admin')->first();
        if ($superAdminRole && !$superAdmin->hasRole('super_admin')) {
            $superAdmin->assignRole('super_admin');
            $this->command->info("✅ Assigned super_admin role to: {$superAdmin->name}");
        }

        $this->command->info("Super Admin user created:");
        $this->command->info("Email: admin@uniworldholidays.com");
        $this->command->info("Password: password");
        $this->command->info("Name: Super Admin");
    }
}