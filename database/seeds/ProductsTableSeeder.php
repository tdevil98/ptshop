<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 5; $i++){
            $name = $faker->name;
            DB::table('products')->insert([
                'name'=> $name,
                'slug' => Str::slug($name, '-'),
                'origin_price' => $faker->numberBetween(500000, 1000000),
                'sale_price' => $faker->numberBetween(400000, 800000),
                'content' => $faker->text('200'),
                'category_id' => 1,
                'status' => 1,
                'user_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
