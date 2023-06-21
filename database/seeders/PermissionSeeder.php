<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['name'=>'products-create', 'guard_name'=>'web'],
            ['name'=>'products-edit', 'guard_name'=>'web'],
            ['name'=>'products-show', 'guard_name'=>'web'],
            ['name'=>'products-delete', 'guard_name'=>'web'],
            ['name'=>'users-create', 'guard_name'=>'web'],
            ['name'=>'users-edit', 'guard_name'=>'web'],
            ['name'=>'users-show', 'guard_name'=>'web'],
            ['name'=>'users-delete', 'guard_name'=>'web'],
            ['name'=>'conditions-create', 'guard_name'=>'web'],
            ['name'=>'conditions-edit', 'guard_name'=>'web'],
            ['name'=>'conditions-show', 'guard_name'=>'web'],
            ['name'=>'conditions-delete', 'guard_name'=>'web'],
        ]);

        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $moderator = Role::create(['name' => 'moderator']);
        $user = Role::create(['name' => 'user']);

        $superAdmin->syncPermissions([
            'products-create',
            'products-edit',
            'products-show',
            'products-delete',
            'users-create',
            'users-edit',
            'users-show',
            'users-delete',
            'conditions-create',
            'conditions-edit',
            'conditions-show',
            'conditions-delete',
        ]);
        
        $admin->syncPermissions([
            'products-create',
            'products-edit',
            'products-show',
            'products-delete',
            'conditions-create',
            'conditions-edit',
            'conditions-show',
            'conditions-delete',
        ]);

        $moderator->syncPermissions([
            'products-create',
            'products-edit',
            'products-show',
            'products-delete',
            'conditions-create',
            'conditions-edit',
            'conditions-show',
            'conditions-delete',
        ]);
    }
}
