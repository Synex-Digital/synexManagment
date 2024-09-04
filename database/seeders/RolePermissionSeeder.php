<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


/**
 * Class RolePermissionSeeder.
 *
 * @see https://spatie.be/docs/laravel-permission/v5/basic-usage/multiple-guards
 *
 * @package App\Database\Seeds
 */
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Enable these options if you need same role and other permission for User Model
         * Else, please follow the below steps for admin guard
         */

        // Create Roles and Permissions
        // $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        // $roleAdmin = Role::create(['name' => 'admin']);
        // $roleEditor = Role::create(['name' => 'editor']);
        // $roleUser = Role::create(['name' => 'user']);


        // Permission List as array
        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    // Dashboard Permissions
                    'dashboard.overView',
                    'dashboard.earnings',
                    'dashboard.expenses',
                    'dashboard.profit',
                    'dashboard.projects',
                    'dashboard.employee',
                    'dashboard.client',
                    'dashboard.totalEarnings',
                    'dashboard.task',

                ]
            ],
            [
                'group_name' => 'employee',
                'permissions' => [
                    'employee.view',
                    'employee.create',
                    'employee.delete',
                    'employee.profile',

                ]
            ],
            [
                'group_name' => 'client',
                'permissions' => [
                    // Blog Permissions
                    'client.view',
                    'client.create',
                    'client.edit',
                    'client.delete',
                    'client.profile',

                ]
            ],
            [
                'group_name' => 'project',
                'permissions' => [
                    // admin Permissions
                    'project.view',
                    'project.overView',
                    'project.create',
                    'project.edit',
                    'project.delete',
                    'project.task.add',
                    'project.task.edit',
                    'project.task.delete',
                    'project.file.add',
                    'project.file.delete',
                    'project.file.download',

                ]
            ],
            [
                'group_name' => 'department',
                'permissions' => [
                    // admin Permissions
                    'department.view',
                    'department.create',
                    'department.edit',
                    'department.delete',

                ]
            ],
            [
                'group_name' => 'expenses',
                'permissions' => [
                    // admin Permissions
                    'expenses.view',
                    'expenses.create',
                    'expenses.edit',
                    'expenses.delete',

                ]
            ],
            [
                'group_name' => 'settings',
                'permissions' => [
                    // admin Permissions
                    'user.view',
                    'user.create',
                    'user.delete',
                    'role.view',
                    'role.create',
                    'role.assign',
                    'roleUser.delete',
                    'rolePermission.delete',
                    'app.view',
                    'appLogo.add',

                ]
            ],
            [
                'group_name' => 'blog',
                'permissions' => [
                    // admin Permissions
                    'blog.view',
                    'blog.create',
                    'blog.edit',
                    'blog.delete',

                ]
            ],


        ];


        // Create and Assign Permissions
        // for ($i = 0; $i < count($permissions); $i++) {
        //     $permissionGroup = $permissions[$i]['group_name'];
        //     for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
        //         // Create Permission
        //         $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
        //         $roleSuperAdmin->givePermissionTo($permission);
        //         $permission->assignRole($roleSuperAdmin);
        //     }
        // }

        // Do same for the admin guard for tutorial purposes
        $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'web']);

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'web']);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }

        // Assign super admin role permission to superadmin user
        $admin = User::where('name', 'Super Admin')->first();
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }
    }
}
