<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurants')->insert([
            'user_id' => 2,
            'name' => 'ataawich',
            'restaurant_categories_id' => 1,
            'phone_number' => '09133134143',
            'status' => 'open',
            'account_number' => '520',
        ]);
    }
}
