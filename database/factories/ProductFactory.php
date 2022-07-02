<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>   $this->faker->name(),
            'description' =>   $this->faker->sentence(),
            'purchase_price' => $this->faker->numberBetween(20, 100),
            'sale_price' => $this->faker->numberBetween(30, 200),
        ];
    }
}
