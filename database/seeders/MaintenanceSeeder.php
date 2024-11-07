<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maintenance;

class MaintenanceSeeder extends Seeder
{
    public function run()
    {
        Maintenance::create([
            'product_id' => 1,
            'machine_id' => 1,
            'user_id' => 1,
            'status' => 'Completed',
            'date' => '2024-11-07 09:00:00',
        ]);
        
        Maintenance::create([
            'product_id' => 2,
            'machine_id' => 2,
            'user_id' => 2,
            'status' => 'Scheduled',
            'date' => '2024-11-08 11:00:00',
        ]);
    }
}
