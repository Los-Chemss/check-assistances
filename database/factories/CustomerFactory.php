<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Membership;
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
        $cus = Customer::select('code')->get();
        $codes = [];
        foreach ($cus as $c) {
            array_push($codes, $c->code);
        }
        $unique = null;
        do {
            $unique = $this->faker->numberBetween(0001, 9999);
        } while (in_array($this->faker->numberBetween(0001, 9999), $codes));


        return [
            'name' => $this->faker->name(),
            'code' => $unique,
            'income' => $this->faker->dateTime(),
            'membership_id' =>  function () {
                return  Membership::query()->inRandomOrder()->first()->id;
            },
            'company_id' => function () {
                return  Company::query()->inRandomOrder()->first()->id;
            },
        ];
    }
}
