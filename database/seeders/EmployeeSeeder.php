<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $faker = Faker::create();
            $customer = new Employee();
            $customer->first_name = $faker->firstName;
            $customer->last_name = $faker->lastName;
            $customer->username = $faker->userName;
            $customer->email = $faker->email;
            $customer->save();
        }
    }
}
