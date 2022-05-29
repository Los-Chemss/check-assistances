<?php

namespace Database\Factories;

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
        // $paid = $this->faker->dateTime();
        return [
            'paid_at' => $this->faker->dateTime(),
            'expires_at' => $this->faker->dateTime(),
            'amount' => 300,
            'customer_id' => $customer,
            'membership_id' => 3,
        ];
    }
}
