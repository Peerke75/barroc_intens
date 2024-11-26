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
            'malfunction_id' => 1,
            'description' => 'apparaat gaat niet aan',
            'priority' => true,
            'location' => 'Customer\'s home',
            'date' => '2024-11-07 10:00:00',
            'status' => 'In Progress',
            'start_appointment' => '10:00:00',
            'end_appointment' => '12:00:00',
        ]);
        
        CustomerService::create([
            'customer_id' => 2,
            'user_id' => 2,
            'malfunction_id' => 2,
            'description' => 'spuit mondje is lek',
            'priority' => false,
            'location' => 'Customer\'s home',
            'date' => '2024-11-07 14:00:00',
            'status' => 'Pending',
            'start_appointment' => '14:00:00',
            'end_appointment' => '16:00:00',	
        ]);
    }
}
