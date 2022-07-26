<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('food')->insert([
            'name' => 'peperoni',
            'restaurant_id' => 1,
            'food_categories_id' => 1,
            'discount_id' => null,
            'raw_material' => null,
            'price' => 120,
            'final_price' => 120,
            'image_path' => 'food/images/food.jpg'

        ]);
    }
}
