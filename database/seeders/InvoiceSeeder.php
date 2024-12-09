<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{

    public function run()
    {
        // Example of manually adding invoices for specific customers
        $customer1 = Customer::find(1); // Assuming you have a customer with ID 1
        $customer2 = Customer::find(2); // Assuming you have a customer with ID 2

        if ($customer1) {
            Invoice::create([
                'customer_id' => $customer1->id,
                'invoice_number' => 'INV-1001',
                'quantity' => 2,
                'description' => 'Consulting services for project X',
                'price' => 150.00,
                'total' => 300.00, // quantity * price
            ]);
            $customers = Customer::all();

            $faker = Faker::create();

            foreach ($customers as $customer) {
                foreach (range(1, rand(1, 5)) as $i) {
                    // Generate a random invoice number
                    $invoiceNumber = 'INV-' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);

                    Invoice::create([
                        'customer_id' => $customer->id,
                        'invoice_number' => $invoiceNumber,
                        'description' => $faker->sentence(),
                        'price' => $faker->randomFloat(2, 50, 1000),
                        'quantity' => rand(1, 5),
                        'total' => $faker->randomFloat(2, 50, 1000),
                    ]);
                }
            }

            if ($customer2) {
                Invoice::create([
                    'customer_id' => $customer2->id,
                    'invoice_number' => 'INV-1002',
                    'quantity' => 1,
                    'description' => 'Software subscription for 1 year',
                    'price' => 200.00,
                    'total' => 200.00,
                ]);
            }

            // Add more customers and invoices as needed
        }
    }
}
