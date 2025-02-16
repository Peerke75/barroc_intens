<?php

namespace Database\Seeders;

use App\Models\Sales;
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
            UsersSeeder::class,
            EventSeeder::class,
            OrdersSeeder::class,
            ProposalsSeeder::class,
            OrderLinesSeeder::class,
            ProposalPriceLinesSeeder::class,
            MalfunctionsSeeder::class,
            ScheduleSeeder::class,
            MachinesSeeder::class,
            MaintenanceSeeder::class,
            InvoiceSeeder::class,
            SalesSeeder::class
        ]);
    }
}

