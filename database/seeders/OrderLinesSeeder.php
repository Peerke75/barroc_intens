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
            'product_id' => 1,
            'quantity'=> 12,
            'total_price' =>2399.88,
        ]);

        OrderLine::create([
            'order_id' => 2,
            'product_id' => 2,
            'quantity'=> 4,
            'total_price' =>199.96,
        ]);
    }
}
