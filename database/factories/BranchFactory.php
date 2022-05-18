<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    public function definition()
    {
        return [
            'division' => $this->faker->name(),
            'location' => $this->faker->address(),
            'company_id' => function () {
                return  Company::query()->inRandomOrder()->first()->id;
            },
        ];
    }
}
