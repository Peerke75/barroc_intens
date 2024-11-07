<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        Schedule::create([
            'malfunction_id' => 1,
            'notes' => 'Scheduled for inspection.',
            'date' => '2024-11-08 10:00:00',
        ]);
        
        Schedule::create([
            'malfunction_id' => 2,
            'notes' => 'Customer complaint under review.',
            'date' => '2024-11-09 12:00:00',
        ]);
    }
}
