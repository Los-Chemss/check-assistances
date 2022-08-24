<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Membership;
use App\Models\Payment;
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
        $customer = Customer::query()/* ->where('company_id', 1) */->inRandomOrder()->first();
        $membership =   Membership::query()->inRandomOrder()->first();
        $customer->membership_id = $membership->id;
        $companyId = function () {
            return Company::query()->inRandomOrder()->first()->id;
        };

        $date = $this->faker->dateTimeBetween($customer->income, 'now');
        $pay = Payment::where('customer_id', $customer->id)->orderBy('paid_at', 'desc')->first();
        if ($pay) {
            $p = $membership->period;;
            $date = date('Y-m-d', strtotime($pay->paid_at . " + $p days"));
        }
        $output = $date->format('Y-m-d');
        // dd($output);
        return [
            'paid_at' => $output,
            'expires_at' =>  date('Y-m-d', strtotime($output . "+" . $membership['period'] . "days")),
            'amount' => $membership->price,
            'customer_id' => $customer->id,
            'membership_id' => $membership->id,
            'registered_on_branch_id' => function () use ($companyId) {
                return  Branch::query()/* ->where('company_id', $companyId) */->inRandomOrder()->first()->id;
            },
        ];
    }
}
