<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::factory( )->create([
            'name'=>"Admin"
        ]);
       $editor =   Role::factory( )->create([
            'name'=>"Editor"
        ]);
       $viewer =  Role::factory( )->create([
            'name'=>"Viewer"
        ]);
        $permissions = Permission::all();
        $admin->permissions()->attach($permissions->pluck('id')) ; 
        $editor->permissions()->attach($permissions->where('id','!=',4)->pluck('id'));
        $viewer->permissions()->attach([1,3,5,7]);
    }
}
