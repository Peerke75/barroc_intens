<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Malfunction;
use Carbon\Carbon;

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

        Malfunction::create([
            'product_id' => 3,
            'customer_id' => 3,
            'message' => 'Machine overheating.',
            'status' => 'Resolved',
            'date' => '2024-11-05 10:30:00',
        ]);

        Malfunction::create([
            'product_id' => 4,
            'customer_id' => 4,
            'message' => 'Power failure.',
            'status' => 'Pending',
            'date' => '2024-11-08 16:00:00',
        ]);

        Malfunction::create([
            'product_id' => 5,
            'customer_id' => 5,
            'message' => 'Display malfunction.',
            'status' => 'In Progress',
            'date' => '2024-11-07 13:00:00',
        ]);

        Malfunction::create([
            'product_id' => 6,
            'customer_id' => 6,
            'message' => 'Error code 404 displayed.',
            'status' => 'Pending',
            'date' => '2024-11-09 11:45:00',
        ]);

        Malfunction::create([
            'product_id' => 7,
            'customer_id' => 7,
            'message' => 'Screen flickering.',
            'status' => 'Resolved',
            'date' => '2024-11-04 08:15:00',
        ]);

        Malfunction::create([
            'product_id' => 8,
            'customer_id' => 8,
            'message' => 'Connectivity issues.',
            'status' => 'In Progress',
            'date' => '2024-11-03 18:30:00',
        ]);

        Malfunction::create([
            'product_id' => 9,
            'customer_id' => 9,
            'message' => 'Water leakage.',
            'status' => 'Pending',
            'date' => '2024-11-10 07:00:00',
        ]);

        Malfunction::create([
            'product_id' => 10,
            'customer_id' => 10,
            'message' => 'Buttons not responding.',
            'status' => 'Resolved',
            'date' => '2024-11-05 15:00:00',
        ]);

        Malfunction::create([
            'product_id' => 11,
            'customer_id' => 11,
            'message' => 'System crashed.',
            'status' => 'Pending',
            'date' => '2024-11-06 12:00:00',
        ]);

        Malfunction::create([
            'product_id' => 12,
            'customer_id' => 12,
            'message' => 'Broken sensor.',
            'status' => 'In Progress',
            'date' => '2024-11-02 10:00:00',
        ]);

        Malfunction::create([
            'product_id' => 13,
            'customer_id' => 13,
            'message' => 'No power supply.',
            'status' => 'Resolved',
            'date' => '2024-11-07 17:00:00',
        ]);

        Malfunction::create([
            'product_id' => 14,
            'customer_id' => 14,
            'message' => 'Software glitch.',
            'status' => 'Pending',
            'date' => '2024-11-04 19:30:00',
        ]);
    }
}
