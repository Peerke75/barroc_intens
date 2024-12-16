<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'amount' => $this->faker->numberBetween(1, 100),
            'ean' => $this->faker->numberBetween(10000000, 99999999),
        ];
    }
}
