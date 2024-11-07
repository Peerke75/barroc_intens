<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            CacheSeeder::class,
            ContactPersonsSeeder::class,
            ContractsSeeder::class,
            CustomersSeeder::class,
            FunctionsSeeder::class,
            JobsSeeder::class,
            ProductCategoriesSeeder::class,
            ProductsSeeder::class,
            StoragesSeeder::class,
            UsersSeeder::class,
        ]);
    }
}

