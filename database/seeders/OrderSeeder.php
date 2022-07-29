<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
           'user_id' => 3,
            'restaurant_id' => 1,
            'customer_status' => 'paid',
            'seller_status' => 'delivered',
            'total_price' => '240',
            'created_at' => Carbon::now(),
        ]);

        DB::table('orders')->insert([
            'user_id' => 3,
            'restaurant_id' => 1,
            'customer_status' => 'paid',
            'seller_status' => 'delivered',
            'total_price' => '120',
            'created_at' => Carbon::now(),
        ]);


        DB::table('orders')->insert([
            'user_id' => 3,
            'restaurant_id' => 1,
            'customer_status' => 'paid',
            'seller_status' => 'delivered',
            'total_price' => '600',
            'created_at' => Carbon::now(),
        ]);


        DB::table('orders')->insert([
            'user_id' => 3,
            'restaurant_id' => 1,
            'customer_status' => 'paid',
            'seller_status' => 'delivered',
            'total_price' => '120',
            'created_at' => Carbon::now()->subDays(4),
        ]);


        DB::table('orders')->insert([
            'user_id' => 3,
            'restaurant_id' => 1,
            'customer_status' => 'paid',
            'seller_status' => 'delivered',
            'total_price' => '240',
            'created_at' => Carbon::now()->subWeeks(2),
        ]);


        DB::table('orders')->insert([
            'user_id' => 3,
            'restaurant_id' => 1,
            'customer_status' => 'paid',
            'seller_status' => 'delivered',
            'total_price' => '240',
            'created_at' => Carbon::now()->subWeeks(2),
        ]);


        DB::table('orders')->insert([
            'user_id' => 3,
            'restaurant_id' => 1,
            'customer_status' => 'paid',
            'seller_status' => 'delivered',
            'total_price' => '240',
            'created_at' => Carbon::now()->subWeeks(3),
        ]);


        DB::table('orders')->insert([
            'user_id' => 3,
            'restaurant_id' => 1,
            'customer_status' => 'paid',
            'seller_status' => 'delivered',
            'total_price' => '240',
            'created_at' => Carbon::now()->subMonths(2),
        ]);


        DB::table('orders')->insert([
            'user_id' => 3,
            'restaurant_id' => 1,
            'customer_status' => 'paid',
            'seller_status' => 'delivered',
            'total_price' => '240',
            'created_at' => Carbon::now()->subMonths(2),
        ]);
    }
}
