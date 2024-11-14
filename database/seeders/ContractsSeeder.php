<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContractsSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('contracts')->insert([
            'order_status' => 'active',
            'startdate' => Carbon::now()->toDateTimeString(),
            'enddate' => Carbon::now()->addMonths(12)->toDateTimeString(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('contracts')->insert([
            'order_status' => 'pending',
            'startdate' => Carbon::now()->addMonths(2)->toDateTimeString(),
            'enddate' => Carbon::now()->addMonths(14)->toDateTimeString(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
