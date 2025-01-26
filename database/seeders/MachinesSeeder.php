<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Machine;

class MachinesSeeder extends Seeder
{
    public function run()
    {
        Machine::create([
            'malfunction_id' => 1,
            'lease_contract_id' => 1,
            'name' => 'Machine 1',
            'price' => 1500.00,
            'status' => 'active',
        ]);

        Machine::create([
            'malfunction_id' => 2,
            'lease_contract_id' => 2,
            'name' => 'Machine 2',
            'price' => 2000.00,
            'status' => 'maintenance',
        ]);
    }
}
