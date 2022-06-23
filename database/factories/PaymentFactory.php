<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customer = Customer::query()->where('company_id', 2)->inRandomOrder()->first()->id;
        $companyId = function () {
            return Company::query()->inRandomOrder()->first()->id;
        };

        // $paid = $this->faker->dateTime();
        return [
            'paid_at' => $this->faker->dateTime(),
            'expires_at' => $this->faker->dateTime(),
            'amount' => 300,
            'customer_id' => $customer,
            'membership_id' => 3,
            'registered_on_branch_id' => function () use ($companyId) {
                return  Branch::query()/* ->where('company_id', $companyId) */->inRandomOrder()->first()->id;
            },
        ];
    }
}
