<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedules')->insert([
            'restaurant_id' => 1,
            'saturday' => '10:00,23:00',
            'sunday' => null,
            'monday' => null,
            'tuesday' => null,
            'wednesday' => null,
            'thursday' => null,
            'friday' => null,
        ]);
    }
}
