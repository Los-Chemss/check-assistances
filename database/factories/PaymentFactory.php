<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Membership;
use DateTime;
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
        $customer = Customer::query()->where('company_id', 1)->inRandomOrder()->first()->id;
        $companyId = function () {
            return Company::query()->inRandomOrder()->first()->id;
        };
        $date = $this->faker->dateTimeBetween('-3 years', 'now');
        $output = $date->format('Y-m-d');
        // dd($output);
        $membership =   Membership::query()->inRandomOrder()->first();
        return [
            'paid_at' => $date,
            'expires_at' =>  date('Y-m-d', strtotime($output . "+" . $membership['period'] . " days")),
            'amount' => 300,
            'customer_id' => $customer,
            'membership_id' => $membership->id,
            'registered_on_branch_id' => function () use ($companyId) {
                return  Branch::query()/* ->where('company_id', $companyId) */->inRandomOrder()->first()->id;
            },
        ];
    }
}
