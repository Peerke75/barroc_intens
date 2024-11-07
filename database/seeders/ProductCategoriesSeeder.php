<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoriesSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('product_categories')->insert([
            'type' => 'Electronics',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_categories')->insert([
            'type' => 'Furniture',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_categories')->insert([
            'type' => 'Clothing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
