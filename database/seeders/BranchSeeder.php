<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Branch::factory()->count(3)->create();

        Branch::create(
            [
                'division' => 'Sucursal 1',
                'location' => 'Santa Elena, Experiencia',
                'company_id' => 1
            ]
        );
        Branch::create(
            [
                'division' => 'Sucursal 2',
                'location' => 'Tucson',
                'company_id' => 1

            ]
        );
        Branch::create(
            [
                'division' => 'Sucursal 3',
                'location' => ' Filosofos',
                'company_id' => 1
            ]
        );
    }
}
