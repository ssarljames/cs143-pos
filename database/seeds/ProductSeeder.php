<?php

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();

        $categoryCount = Category::count();

        for($i=0; $i<50; $i++) {
            DB::table("products")->insert([
                "category_id" => $faker->numberBetween(1, $categoryCount),
                "name" => $faker->company,
                "price" => $faker->numberBetween(5, 200),
                "unit_type" => $faker->randomElement(array_keys(Product::UNIT_TYPES)),
                "available_stock" => $faker->numberBetween(10, 100),
            ]);
        }
    }
}
