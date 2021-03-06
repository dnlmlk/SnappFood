<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            RestaurantCategoriesSeeder::class,
            FoodCategoriesSeeder::class,
            DiscountSeeder::class,
            AddressSeeder::class,
            RestaurantSeeder::class,
            ScheduleSeeder::class,
            FoodSeeder::class,
            OrderSeeder::class,
            Food_OrderSeeder::class,
        ]);
    }
}
