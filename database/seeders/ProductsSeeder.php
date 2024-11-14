<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            'storage_id' => 1,
            'product_category_id' => 1,
            'name' => 'Product 1',
            'price' => 199.99,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'storage_id' => 2,
            'product_category_id' => 2,
            'name' => 'Product 2',
            'price' => 49.99,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('products')->insert([
            'storage_id' => 3,
            'product_category_id' => 3,
            'name' => 'Product 3',
            'price' => 29.99,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

