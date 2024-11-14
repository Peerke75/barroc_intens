<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomerService;

class CustomerServicesSeeder extends Seeder
{
    public function run()
    {
        CustomerService::create([
            'customer_id' => 1,
            'user_id' => 1,
            'date' => '2024-11-07 10:00:00',
            'status' => 'In Progress',
            'priority' => true,
        ]);
        
        CustomerService::create([
            'customer_id' => 2,
            'user_id' => 2,
            'date' => '2024-11-07 11:00:00',
            'status' => 'Completed',
            'priority' => false,
        ]);
    }
}
