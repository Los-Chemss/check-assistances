<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Seeder
        $this->call([
            UserTableSeeder::class,
            CompanySeeder::class,
            MembershipSeeder::class,
            BranchSeeder::class,
            CustomerSeeder::class,
            AssistanceSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
