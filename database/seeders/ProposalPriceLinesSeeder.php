<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProposalPriceLine;

class ProposalPriceLinesSeeder extends Seeder
{
    public function run()
    {
        ProposalPriceLine::create([
            'proposal_id' => 1,
            'product_id' => 1,
            'amount' => 5,
            'price' => 100.00,
        ]);

        ProposalPriceLine::create([
            'proposal_id' => 2,
            'product_id' => 2,
            'amount' => 3,
            'price' => 200.00,
        ]);
    }
}
