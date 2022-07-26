<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'addressable_type' => 'App\Models\Restaurant',
            'addressable_id' => 1,
            'title' => 'location',
            'address' => 'Abshar',
            'latitude' => '12.6',
            'longitude' => '36.3',
        ]);

        DB::table('addresses')->insert([
            'addressable_type' => 'App\Models\User',
            'addressable_id' => 3,
            'title' => 'Home',
            'address' => 'Abshar',
            'latitude' => '12.6',
            'longitude' => '36.3',
            'active' => '1',
        ]);
    }
}
