<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'product_id' => 1,
            'user_id' => 1,
            'date' => '2024-11-07 09:00:00',
        ]);
        
        Order::create([
            'product_id' => 2,
            'user_id' => 2,
            'date' => '2024-11-06 14:30:00',
        ]);
    }
}
