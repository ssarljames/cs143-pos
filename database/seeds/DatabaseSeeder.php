<?php

use App\User;
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
         DB::table("users")->insert([
             "first_name" => "Administrator",
             "last_name" => "",
             "username" => "admin",
             "role" => User::ADMIN,
             "password" => bcrypt("password")
         ]);
    }
}
