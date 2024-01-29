<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            ['name'=>'view_users'],
            ['name'=>'edit_users'],
            ['name'=>'view_users'],
            ['name'=>'edit_roles'],
            ['name'=>'view_products'],
            ['name'=>'edit_products'],
            ['name'=>'view_orders'],
            ['name'=>'edit_orders'],

        ]);
    }
}
