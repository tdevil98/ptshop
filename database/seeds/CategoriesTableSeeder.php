<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Vans', 'Converse', 'Adidas', 'Nike'];
        foreach ($names as $name)
            DB::table('categories')->updateOrInsert([
                'slug' => Str::slug($name, '-')
            ],
                [
                    'name' => $name,
                    'parent_id' => 0,
                    'user_id' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
    }
}
