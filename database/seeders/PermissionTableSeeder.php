<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
//    public function run()
//    {
//
//        $roles = [
//            'admin',
//            'editor',
//            'viewer'
//        ];
//
//        $permissions = [
//            'view-book',
//            'edit-book',
//            'delete-book'
//        ];
//
//        foreach ($roles as $role) {
//            Role::create(['name' => $role, 'guard_name' => 'staff']);
//        }
//
//        foreach ($permissions as $permission) {
//            Permission::create(['name' => $permission, 'guard_name' => 'staff']);
//        }
//    }

    public function run()
    {
        $permissions = [
            'create-book',
            'edit-book',
            'view-book',
            'delete-book',
            'create-user',
            'activate-inactivate-user',
            'assign-books'
        ];

        $roles = [
            'admin',
            'editor',
            'viewer',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'staff']);
        }

        foreach ($roles as $roleName) {
            $role = Role::create(['name' => $roleName, 'guard_name' => 'staff']);

            if ($roleName === 'admin') {
                $role->syncPermissions(Permission::all());
            } elseif ($roleName === 'editor') {
                $role->syncPermissions([
                    'edit-book',
                    'assign-books',
                ]);
            } elseif ($roleName === 'viewer') {
                $role->syncPermissions([
                    'view-book',
                ]);
            }
        }
    }
}
