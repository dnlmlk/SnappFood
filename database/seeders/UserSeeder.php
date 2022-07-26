<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('12345678')
        ]);

        DB::table('users')->insert([
            'name' => 'seller',
            'email' => 'seller@gmail.com',
            'role' => 'seller',
            'password' => Hash::make('12345678')
        ]);

        DB::table('users')->insert([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'role' => 'customer',
            'password' => Hash::make('12345678')
        ]);

    }
}
