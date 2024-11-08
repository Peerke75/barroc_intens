<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderLine;

class OrderLinesSeeder extends Seeder
{
    public function run()
    {
        OrderLine::create([
            'order_id' => 1,
            'amount' => 2,
            'price' => 250.00,
        ]);
        
        OrderLine::create([
            'order_id' => 2,
            'amount' => 1,
            'price' => 500.00,
        ]);
    }
}
