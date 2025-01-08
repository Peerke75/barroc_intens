<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'company_name' => $this->faker->company,
            'name' => $this->faker->name,
            'mail' => $this->faker->unique()->safeEmail,
            'BKR_check' => $this->faker->boolean(50), // 50% kans om true/false te zijn
            'order_status' => $this->faker->randomElement(['active', 'pending', 'inactive']),

            'contract_id' => 1,
            'contact_persons_id' => 1
        ];
    }
}
