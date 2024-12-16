<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('sales')->insert([
            'customer_id' => 1,
            'user_id' => 1,
            'malfunction_id' => 1,
            'description' => 'The customer has a problem with the computer.',
            'priority' => 'High',
            'location' => 'Customer location',
            'date' => '2024-11-29',
            'status' => 'Open',
            'start_appointment' => Carbon::parse('2024-11-29 10:00:00'),
            'end_appointment' => Carbon::parse('2024-11-29 11:00:00'),
        ]);

        DB::table('sales')->insert([
            'customer_id' => 2,
            'user_id' => 1,
            'malfunction_id' => 2,
            'description' => 'The customer has a problem with the printer.',
            'priority' => 'Medium',
            'location' => 'Customer location',
            'date' => '2024-11-30',
            'status' => 'Open',
            'start_appointment' => Carbon::parse('2024-11-29 10:00:00'),
            'end_appointment' => Carbon::parse('2024-11-29 11:00:00'),
        ]);

        DB::table('sales')->insert([
            'customer_id' => 3,
            'user_id' => 1,
            'malfunction_id' => 3,
            'description' => 'The customer has a problem with the network.',
            'priority' => 'Low',
            'location' => 'Customer location',
            'date' => '2024-12-01',
            'status' => 'Open',
            'start_appointment' => Carbon::parse('2024-11-29 10:00:00'),
            'end_appointment' => Carbon::parse('2024-11-29 11:00:00'),
        ]);

    }
}
