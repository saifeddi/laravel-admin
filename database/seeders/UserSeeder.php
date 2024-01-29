<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(20)->create();

        User::factory( )->create([
            'first_name'=>"Admin",
            'last_name'=>"Admin",
            'email'=>'admin@mail.com',
            'role_id'=>1
        ]);

        User::factory( )->create([
            'first_name'=>"Editor",
            'last_name'=>"Editor",
            'email'=>'editor@mail.com',
            'role_id'=>2
        ]);

        User::factory( )->create([
            'first_name'=>"Viewer",
            'last_name'=>"Viewer",
            'email'=>'viewer@mail.com',
            'role_id'=>3
        ]);
    }
}
