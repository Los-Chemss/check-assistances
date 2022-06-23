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
                'division' => 'Santa Elena',
                'location' => 'Santa Elena, Experiencia',
                'company_id' => 1
            ]
        );
        Branch::create(
            [
                'division' => 'Jardines alcalde',
                'location' => 'Amado aguirre',
                'company_id' => 1

            ]
        );
        Branch::create(
            [
                'division' => 'Colinas de la normal',
                'location' => ' Av. Paseo de los filosofos',
                'company_id' => 1
            ]
        );
    }
}
