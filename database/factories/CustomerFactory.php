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
        do {
            $unique = $this->faker->numberBetween(0001, 9999);
        } while (!in_array($this->faker->numberBetween(0001, 9999), $codes));

        $companyId = function () {
            return Company::query()->inRandomOrder()->first()->id;
        };

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
            'registered_on_branch_id'=> function () use ($companyId) {
                return  Branch::query()/* ->where('company_id', $companyId) */->inRandomOrder()->first()->id;
            },
        ];
    }
}
