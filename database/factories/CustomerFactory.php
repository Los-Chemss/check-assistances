<?php

namespace Database\Factories;

use App\Models\Branch;
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
        $companyId = function () {
            return Company::query()->inRandomOrder()->first()->id;
        };
        do {
            $unique = $this->faker->numberBetween(1000, 9999);
        } while (in_array($unique, $codes, true));

        if (in_array($unique, $codes, true)) {
            $cs = Customer::where('code', $unique)->get();
            foreach ($cs as $c) {
                if ($c) {
                    $c->delete();
                }
            }
            dd($codes);
            // return;
        }

        return [
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'code' => $unique,
            'income' => $this->faker->dateTime(),
            'membership_id' =>  function () use ($companyId) {
                return  Membership::query()/* ->where('company_id', $companyId) */->inRandomOrder()->first()->id;
            },
            'company_id' => $companyId,
            'address' => $this->faker->address(),
            'province' => $this->faker->state(),
            'postcode' => $this->faker->postcode(),
            'phone' => $this->faker->phoneNumber(),
            'registered_on_branch_id' => function () use ($companyId) {
                return  Branch::query()/* ->where('company_id', $companyId) */->inRandomOrder()->first()->id;
            },
        ];

    }
}
