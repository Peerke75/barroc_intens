<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Malfunction;

class MalfunctionsSeeder extends Seeder
{
    public function run()
    {
        Malfunction::create([
            'product_id' => 1,
            'customer_id' => 1,
            'message' => 'Machine not starting.',
            'status' => 'Pending',
            'date' => '2024-11-07 09:00:00',
        ]);
        
        Malfunction::create([
            'product_id' => 2,
            'customer_id' => 2,
            'message' => 'Strange noise coming from machine.',
            'status' => 'In Progress',
            'date' => '2024-11-06 14:00:00',
        ]);
    }
}
