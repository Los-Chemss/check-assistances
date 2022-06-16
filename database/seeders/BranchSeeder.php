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
                'division'=>'Sucursal 1',
                'location'=>'Santa Elena, Experiencia'
            ]);
        Branch::create(
            [
                'division'=>'Sucursal 2',
                'location'=>'Tucson'
            ]);
        Branch::create(
            [
                'division'=>'Sucursal 3',
                'location'=>' Filosofos'
            ]);
    }
}
