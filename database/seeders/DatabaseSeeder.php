<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            AdminUserSeeder::class,
            DemoDataSeeder::class,
            RichDemoSeeder::class,
            RichToursStep2Seeder::class,
            RichToursStep3Seeder::class,
            RichToursStep4Seeder::class,
            RichToursStep5Seeder::class,
            RichToursStep6Seeder::class,
        ]);
    }
}
