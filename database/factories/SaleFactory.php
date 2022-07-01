<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => function () {
                return Product::query()->inRandomOrder()->first()->id;
            },
            'quantity' =>   $this->faker->randomElement([10, 100, 500])
        ];
    }
}
