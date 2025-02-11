<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'display_name' => 'Super Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'site_admin',
                'display_name' => 'site Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'user',
                'display_name' => 'Normal User',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
