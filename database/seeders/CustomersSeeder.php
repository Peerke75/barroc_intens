<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Invoice; // Import the Invoice model

class CustomersSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create(); // Initialize Faker

        // Insert 3 predefined customers
        DB::table('customers')->insert([
            'contract_id' => 1,
            'contact_persons_id' => 1,
            'company_name' => 'Company A',
            'name' => 'John Doe',
            'mail' => 'johndoe@companya.com',
            'BKR-check' => true,
            'order_status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('customers')->insert([
            'contract_id' => 2,
            'contact_persons_id' => 2,
            'company_name' => 'Company B',
            'name' => 'Jane Smith',
            'mail' => 'janesmith@companyb.com',
            'BKR-check' => false,
            'order_status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('customers')->insert([
            'contract_id' => 3,
            'contact_persons_id' => 3,
            'company_name' => 'Company C',
            'name' => 'Alice Brown',
            'mail' => 'alicebrown@companyc.com',
            'BKR-check' => true,
            'order_status' => 'inactive',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

            foreach (range(4, 53) as $index) {
                $customerId = DB::table('customers')->insertGetId([
                    'contract_id' => $faker->randomDigitNotNull,
                    'contact_persons_id' => $faker->randomDigitNotNull,
                    'company_name' => $faker->company,
                    'name' => $faker->name,
                    'mail' => $faker->unique()->safeEmail,
                    'BKR-check' => $faker->boolean,
                    'order_status' => $faker->randomElement(['active', 'pending', 'inactive']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
         }

    }
}


