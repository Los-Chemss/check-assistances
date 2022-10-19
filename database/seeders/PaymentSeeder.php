<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Membership;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use File;

class PaymentSeeder extends Seeder
{
   static function convertToDate($strVal)
    {
        $exp = explode('/', $strVal);
        return date('Y-m-d', strtotime($exp[2] . '/' . $exp[0] . '/' . $exp[1]));
    }
    public function run()
    {

        // Payment::factory()->count(20)->create();
        $socios = File::get("database/data/customers.json");
        $sociosList = (json_decode($socios));

   /*      function convertToDate($strVal)
        {
            $exp = explode('/', $strVal);
            return date('Y-m-d', strtotime($exp[2] . '/' . $exp[0] . '/' . $exp[1]));
        } */

        foreach ($sociosList as $key => $socios) {
            $br = ($key === 'ja' ? 2 : ($key === 'cn' ? 3 : 1));
            foreach ($socios as  $socio) {
                $membershipId = ($socio->{'Detalles de Membresía'} === "BIMESTRE" ? 2
                    : ($socio->{'Detalles de Membresía'} === "MENSUALIDAD" ?
                        1 : ($socio->{'Detalles de Membresía'} === "TRIMESTRE" ? 3
                            : ($socio->{'Detalles de Membresía'} === "FAMILIAR MENSUALIDAD"
                                ? 4
                                : ($socio->{'Detalles de Membresía'} === "NUEVO INGRESO"
                                    ? 5
                                    : null)))));

                $starts = $socio->{'Comienza'} ? self::convertToDate($socio->{'Comienza'}) : null;
                $ends = $socio->{'Termina'} ? self::convertToDate($socio->{'Termina'}) : null;

                $customer = Customer::where('name', $socio->{'Nombre'})->where('lastname', $socio->{'Apellido Paterno'} . ' ' . $socio->{'Apellido Materno'})->select('id', 'registered_on_branch_id')->first();
                $membership = Membership::where('id', $membershipId)->first();


                $newPayment = [
                    'paid_at' => $starts,
                    'expires_at' =>  $ends,
                    'amount' => $membership ? $membership->price : 0,
                    'customer_id' => $customer ? $customer->id : 1,
                    'membership_id' => $membership ? $membership->id : 1,
                    'registered_on_branch_id' => $customer->registered_on_branch_id,
                ];
                Payment::create($newPayment);
            }
        }
    }
}
