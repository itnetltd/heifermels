<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        Permission::firstOrCreate(['name' => 'manage-users']);
        Permission::firstOrCreate(['name' => 'manage-projects']);
        Permission::firstOrCreate(['name' => 'manage-activities']);
        Permission::firstOrCreate(['name' => 'view-reports']);
        Permission::firstOrCreate(['name' => 'manage-finance']);

        // Roles
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $projectManager = Role::firstOrCreate(['name' => 'project-manager']);
        $partnerFocal = Role::firstOrCreate(['name' => 'partner-focal-point']);
        $viewer = Role::firstOrCreate(['name' => 'viewer']);

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all());

        $projectManager->givePermissionTo([
            'manage-projects',
            'manage-activities',
            'view-reports',
            'manage-finance',
        ]);

        $partnerFocal->givePermissionTo([
            'manage-activities',
            'view-reports',
        ]);

        $viewer->givePermissionTo([
            'view-reports',
        ]);
    }
}
