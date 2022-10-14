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
                'name' => 'Mensual',
                'price' => 450,
                'company_id' => $company->id,
                'period' => 30,
            ]);
            Membership::create([
                'name' => 'Bimestral',
                'price' => 900,
                'company_id' => $company->id,
                'period' => 60,
            ]);
            Membership::create([
                'name' => 'Trimestral',
                'price' => 1300,
                'company_id' => $company->id,
                'period' => 90,
            ]);


            Membership::create([
                'name' => 'Familiar',
                'price' => 1600,
                'company_id' => $company->id,
                'period' => 30,
            ]);
            Membership::create([
                'name' => 'Nuevo ingreso',
                'price' => 1600,
                'company_id' => $company->id,
                'period' => 30,
            ]);

            /*    Membership::create([
                'name' => 'Anual',
                'price' => 1300,
                'company_id' => $company->id,
                'period' => 365
            ]); */
        }
    }
}
