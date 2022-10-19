<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Membership;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Seeder;
use File;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    static function convertToDate2($strVal)
    {
        $exp = explode('/', $strVal);
        return date('Y-m-d', strtotime($exp[2] . '/' . $exp[0] . '/' . $exp[1]));
    }
    public function run()
    {

        // $socios = File::get("database/data/socios.json");
        $socios = File::get("database/data/customers.json");
        $sociosList = (json_decode($socios));

        $membership =   Membership::query()->inRandomOrder()->first();

        /*    dd($sociosList);
        return;
 */

        foreach ($sociosList as $key => $socios) {
            // dd($key === 'se');
            /*   if ($key === 'se') { //Pertenecen a suc. santa elena
                $br = 1,
            } */
            $factory = new CustomerFactory();
            // dd($factory->definition());

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
                $newSocio = [
                    'name' => $socio->{'Nombre'},
                    'lastname' => $socio->{'Apellido Paterno'} . ' ' . $socio->{'Apellido Materno'},
                    // 'code' => $socio->{'Número de Socio'},
                    'code' => (string)$factory->definition(),
                    'income' => self::convertToDate2($socio->{'Comienza'}),
                    /*       'birthday' => date(
                            'Y-m-d',
                            strtotime(
                                $socio->{'Fecha de Nacimiento'}
                            )
                        ), */
                    'membership_id' => $membershipId,
                    //$membership->id,
                    'company_id' => '1',
                    // 'address' => $socio->{'Domicilio (Calle y Número)'},
                    // 'province' => $socio->{'Estado'},
                    // 'postcode' => $socio->{'Código Postal'},
                    // 'phone' => $socio->{'Teléfono Celular'},
                    'registered_on_branch_id' => $br
                ];
                Customer::create($newSocio);
            }
        }
    }
}
