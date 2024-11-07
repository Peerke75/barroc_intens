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
            CustomerServicesSeeder::class,
            OrdersSeeder::class,
            ProposalsSeeder::class,
            OrderLinesSeeder::class,
            ProposalPriceLinesSeeder::class,
            MalfunctionsSeeder::class,
            ScheduleSeeder::class,
            MachinesSeeder::class,
            MaintenanceSeeder::class,
        ]);
    }
}
