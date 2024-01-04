<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'Product-list',
            'Product-create',
            'Product-edit',
            'Product-delete',
            'Kategori-list',
            'Kategori-create',
            'Kategori-edit',
            'Kategori-delete',
            'Cart-list',
            'Cart-create',
            'Cart-edit',
            'Cart-delete',
            'Client-list',
            'Client-create',
            'Client-edit',
            'Client-delete',
            'Payment-list',
            'Payment-create',
            'Payment-edit',
            'Payment-delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
