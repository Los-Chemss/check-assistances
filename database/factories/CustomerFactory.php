<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'code' => $this->faker->numberBetween(0001, 9999),
            'income' => $this->faker->dateTime(),
            'membership' => $this->faker->randomElement(['monthly', 'yearly']),
            'company_id' => function () {
                return  Company::query()->inRandomOrder()->first()->id;
            },
        ];
    }
}
