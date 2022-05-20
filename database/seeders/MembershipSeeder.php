<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Membership;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    public function run()
    {

        $companies =  Company::select('id')->get();
        foreach ($companies as $company) {
            Membership::create([
                'name' => 'monthly',
                'price' => 300,
                'company_id' => $company->id,
            ]);
            Membership::create([
                'name' => 'yearly',
                'price' => 1300,
                'company_id' => $company->id,
            ]);
        }
    }
}
