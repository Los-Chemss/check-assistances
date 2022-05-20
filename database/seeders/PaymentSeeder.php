<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Membership;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $customers = Customer::select('id', 'company_id')->get();
        foreach ($customers as $customer) {
            $company = Company::where('id', $customer->company_id)->first();
            $membership = Membership::where('company_id', $company->id)
                ->where('name', 'monthly')
                ->select('id')->first();

            Payment::create([
                'paid_at' => '2022-05-20',
                'expires_at' => '2022-06-20',
                'customer_id' => $customer->id,
                'membership_id' => $membership->id,
            ]);
        }
    }
}
