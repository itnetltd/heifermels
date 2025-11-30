<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) Seed roles & permissions (your existing seeder)
        $this->call(RolesAndPermissionsSeeder::class);

        // 2) Create or reuse the test user
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name'     => 'Test User',
                // set a default password if you want to log in with it
                'password' => bcrypt('password'),
            ]
        );

        // 3) Give the test user the super_admin role if it exists
        $superAdminRole = Role::where('name', 'super_admin')->first();

        if ($superAdminRole && !$user->hasRole('super_admin')) {
            $user->assignRole($superAdminRole);
        }

        // If you ever want random users again, just uncomment:
        // User::factory(10)->create();
    }
}
