<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i=0; $i<50; $i++)
            DB::table("customers")->insert([
                "first_name" => $faker->firstName,
                "last_name" => $faker->lastName,
                "address" => $faker->address,
                "contact_number" => $faker->phoneNumber,
                "created_at" => today()->subDays($faker->numberBetween(10, 500))
            ]);
    }
}
