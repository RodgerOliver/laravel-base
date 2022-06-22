<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Reset cached roles and permissions */
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /* Create permissions */
        Permission::create(['name' => 'page create', 'readable_name' => 'Create page']);

        /* Gets all permissions via Gate::before rule; see AuthServiceProvider */
        $role_master = Role::create(['name' => 'master', 'readable_name' => 'Master']);

        /* Create roles and assign existing permissions */
        $role_admin = Role::create(['name' => 'admin', 'readable_name' => 'Administrator']);
        $role_admin->givePermissionTo('page create');

        $role_user = Role::create(['name' => 'user', 'readable_name' => 'User']);

        /* Assign roles to seeded users */
        $user = User::find(1);
        $user->assignRole($role_master);
        $user = User::find(2);
        $user->assignRole($role_admin);
        $user = User::find(3);
        $user->assignRole($role_user);
    }
}
