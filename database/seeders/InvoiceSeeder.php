<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all customers
        $customers = Customer::all();

        // Initialize Faker
        $faker = Faker::create();

        foreach ($customers as $customer) {
            // Create between 1 and 5 invoices for each customer
            foreach (range(1, rand(1, 5)) as $i) {
                // Generate a random invoice number
                $invoiceNumber = 'INV-' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);

                // Create the invoice
                Invoice::create([
                    'customer_id' => $customer->id,
                    'invoice_number' => $invoiceNumber,
                    'description' => $faker->sentence(),
                    'price' => $faker->randomFloat(2, 50, 1000), // Random price between 50 and 1000
                    'quantity' => rand(1, 5), // Random quantity between 1 and 5
                    'total' => $faker->randomFloat(2, 50, 1000),
                ]);
            }
        }
    }
}
