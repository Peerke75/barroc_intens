<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proposal;

class ProposalsSeeder extends Seeder
{
    public function run()
    {
        Proposal::create([
            'user_id' => 1,
            'customer_id' => 1,
            'date' => '2024-11-07 10:30:00',
        ]);

        Proposal::create([
            'user_id' => 2,
            'customer_id' => 2,
            'date' => '2024-11-06 15:00:00',
        ]);
    }
}
