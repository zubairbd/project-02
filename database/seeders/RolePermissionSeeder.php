<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Roles
        $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);
        $roleAdmin = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor', 'guard_name' => 'admin']);
        $roleUser = Role::create(['name' => 'user', 'guard_name' => 'admin']);

        // Permission list array
        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],

            [
                'group_name' => 'blog',
                'permissions' => [
                    // Blog Permission
                    'blog.create',
                    'blog.view',
                    'blog.edit',
                    'blog.delete',
                    'blog.approve',
                ]
            ],

            [
                'group_name' => 'admin',
                'permissions' => [
                    // Admin Permission
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',
                ]
            ],

            [
                'group_name' => 'role',
                'permissions' => [
                    // Role Permission
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',
                ]
            ],

            [
                'group_name' => 'profile',
                'permissions' => [
                    // Profile Permission
                    'profile.view',
                    'profile.edit',
                ]
            ],
            
        ];


        // Create & Assing Permissions
        // 
        for ($i = 0; $i < count($permissions); $i++) { 
            $permissionGroup = $permissions[$i]['group_name'];
            $guardName = 'admin';
            
            for ($j=0; $j < count($permissions [$i]['permissions']); $j++) { 
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'guard_name' => $guardName, 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
            
        }
    }
}
