<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat roles
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleOwner = Role::firstOrCreate(['name' => 'owner']);

        // Buat permissions
        $permissionManageSubscriptions = Permission::firstOrCreate(['name' => 'manage subscriptions']);
        $permissionFreeSubscriptions = Permission::firstOrCreate(['name' => 'free']);
        $permissionBasicSubscriptions = Permission::firstOrCreate(['name' => 'basic']);
        $permissionAdvancedSubscriptions = Permission::firstOrCreate(['name' => 'advanced']);
        $permissionFullSubscriptions = Permission::firstOrCreate(['name' => 'full']);

        // Berikan permissions ke roles
        $roleAdmin->givePermissionTo($permissionManageSubscriptions);
        $roleOwner->givePermissionTo([
            $permissionFreeSubscriptions,
            $permissionBasicSubscriptions,
            $permissionAdvancedSubscriptions,
            $permissionFullSubscriptions,
        ]);
    }
}
