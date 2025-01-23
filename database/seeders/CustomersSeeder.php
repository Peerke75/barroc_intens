<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Invoice;

class CustomersSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('customers')->insert([
            [
                'contract_id' => 1,
                'contact_persons_id' => 1,
                'company_name' => 'Company A',
                'name' => 'John Doe',
                'mail' => 'johndoe@companya.com',
                'BKR_check' => true,
                'order_status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'contract_id' => 2,
                'contact_persons_id' => 2,
                'company_name' => 'Company B',
                'name' => 'Jane Smith',
                'mail' => 'janesmith@companyb.com',
                'BKR_check' => false,
                'order_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'contract_id' => 3,
                'contact_persons_id' => 3,
                'company_name' => 'Company C',
                'name' => 'Alice Brown',
                'mail' => 'alicebrown@companyc.com',
                'BKR_check' => true,
                'order_status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insert 500 random customers using Faker
        foreach (range(4, 503) as $index) {
            DB::table('customers')->insert([
                'contract_id' => $faker->numberBetween(1, 1000),
                'contact_persons_id' => $faker->numberBetween(1, 1000),
                'company_name' => $faker->company,
                'name' => $faker->name,
                'mail' => $faker->unique()->safeEmail,
                'BKR_check' => $faker->boolean,
                'order_status' => $faker->randomElement(['active', 'pending', 'inactive']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
