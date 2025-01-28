<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaseContractsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('leasecontracts')->insert([
            'customer_id' => 1,
            'user_id' => 1,
            'start_date' => now(),
            'end_date' => now()->addYear(),
            'payment_method' => 'credit card',
            'machine_amount' => 1,
            'notice_period' => 'maandelijks',
            'status' => 'pending',
            'created_at' => now(),
        ]);

        DB::table('leasecontracts')->insert([
            'customer_id' => 2,
            'user_id' => 1,
            'start_date' => now(),
            'end_date' => now()->addYear(),
            'payment_method' => 'debit card',
            'machine_amount' => 1,
            'notice_period' => 'per kwartaal',
            'status' => 'pending',
            'created_at' => now(),
        ]);

    }
}
