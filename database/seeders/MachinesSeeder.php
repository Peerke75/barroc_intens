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
            'storage_id' => 1,
            'name' => 'Machine 1',
            'price' => 1500.00,
            'status' => 'Operational',
        ]);

        Machine::create([
            'malfunction_id' => 2,
            'storage_id' => 2,
            'name' => 'Machine 2',
            'price' => 2000.00,
            'status' => 'Under Maintenance',
        ]);
    }
}
