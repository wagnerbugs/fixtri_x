<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class RootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Clear roles and permissions
        DB::table('model_has_permissions')->delete();
        DB::table('model_has_roles')->delete();
        DB::table('role_has_permissions')->delete();
        Permission::query()->delete();
        Role::query()->delete();

        // create permissions
        $permissions = [
            'access_admin_panel',

            // USER
            'view_any_users', 'view_users', 'create_users', 'update_users', 'delete_users',

            // ROLE
            'view_any_roles', 'view_roles', 'create_roles', 'update_roles', 'delete_roles',

            // PERMISSION
            'view_any_permissions', 'view_permissions', 'create_permissions', 'update_permissions', 'delete_permissions',


        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        User::withoutEvents(function () use ($permissions) {
            $role = Role::create(['name' => 'Root']);
            $role->givePermissionTo($permissions);

            $admin = Role::create(['name' => 'Admin']);
            $admin->givePermissionTo($permissions);

            Role::create(['name' => 'Client']);

            $user = User::updateOrCreate(
                ['email' => 'wagnerbugs@gmail.com'],
                [
                    'name' => 'Wagner Bugs',
                    'email_verified_at' => now(),
                    'password' => Hash::make('123456789'),
                ]
            )->assignRole($role);

            UserProfile::updateOrCreate(['user_id' => $user->id]);
        });
    }
}
