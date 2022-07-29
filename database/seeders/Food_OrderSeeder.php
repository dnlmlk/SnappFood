<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Food_OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('food_order')->insert([
            'order_id' => 1,
            'food_id' => 1,
            'count' => 2,
        ]);

        DB::table('food_order')->insert([
            'order_id' => 2,
            'food_id' => 1,
            'count' => 1,
        ]);

        DB::table('food_order')->insert([
            'order_id' => 3,
            'food_id' => 1,
            'count' => 5,
        ]);

        DB::table('food_order')->insert([
            'order_id' => 4,
            'food_id' => 1,
            'count' => 1,
        ]);

        DB::table('food_order')->insert([
            'order_id' => 5,
            'food_id' => 1,
            'count' => 2,
        ]);

        DB::table('food_order')->insert([
            'order_id' => 6,
            'food_id' => 1,
            'count' => 2,
        ]);

        DB::table('food_order')->insert([
            'order_id' => 7,
            'food_id' => 1,
            'count' => 2,
        ]);

        DB::table('food_order')->insert([
            'order_id' => 8,
            'food_id' => 1,
            'count' => 2,
        ]);

        DB::table('food_order')->insert([
            'order_id' => 9,
            'food_id' => 1,
            'count' => 2,
        ]);

    }
}
