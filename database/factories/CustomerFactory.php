<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Membership;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /*    $cus = Customer::select('code')->get();
        $codes = [];
        foreach ($cus as $c) {
            array_push($codes, $c->code);
        } */
        $companyId = function () {
            return Company::query()->inRandomOrder()->first()->id;
        };
        /*
        $unique = null;

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
        } */


        $lastCode = Customer::select(DB::raw("MAX(code) AS code"))->get();
        return str_pad($lastCode[0]->code ? $lastCode[0]->code + 1 : 1, 4, "0", STR_PAD_LEFT);

       /*  $codes = [];
        for ($x = 0001; $x <= 9999; $x++) {
            array_push($codes, str_pad($x, 4, "0", STR_PAD_LEFT));
        }

        return  $this->faker->unique(0, 1000000)->randomElement($codes); */

        return [
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'code' => $this->faker->unique()->randomElement($codes),
            'income' => $this->faker->dateTime(),
            'birthday' => $this->faker->date(),
            'membership_id' =>  function () use ($companyId) {
                return  Membership::query()->inRandomOrder()->first()->id;
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
