<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Pantera',
            'user_name' => 'panterclub',
            'last_name' => 'Club',
            'avatar' => 'https://lorempixel.com/200/200',
            'password' => bcrypt('password'),
            'email' => 'panter@gmail.com',

        ]);
    }
}
