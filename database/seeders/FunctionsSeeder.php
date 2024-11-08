<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FunctionsSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('functions')->insert([
            'name' => 'Administrator',
            'description' => 'Responsible for managing system settings and user permissions.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('functions')->insert([
            'name' => 'Sales Manager',
            'description' => 'Oversees sales operations and customer relations.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('functions')->insert([
            'name' => 'Finance Officer',
            'description' => 'Handles financial transactions, reporting, and budgeting.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
