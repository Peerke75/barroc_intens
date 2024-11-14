<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactPersonsSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('contact_persons')->insert([
            'name' => 'John Doe',
            'mail' => 'john.doe@example.com',
            'number' => 123456789,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('contact_persons')->insert([
            'name' => 'Jane Smith',
            'mail' => 'jane.smith@example.com',
            'number' => 987654321,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
