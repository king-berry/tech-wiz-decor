<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'huudao@gmail.com',
                'password' => Hash::make('huudao'),
                'role' => 'superadmin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'name' => 'Admin User',
            //     'email' => 'admin@example.com',
            //     'password' => Hash::make('password'), 
            //     'role' => 'admin',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}
