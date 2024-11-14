<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoragesSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('storages')->insert([
            'product_names' => 'Product A, Product B',
            'amount' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('storages')->insert([
            'product_names' => 'Product C, Product D',
            'amount' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
