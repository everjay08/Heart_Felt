<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            'fname' => 'Diana',
            'lname' => 'Claire',
            'email' => 'diana@gmail.com',
            'is_admin' => '0',
            'password' => Hash::make('Password123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);



        // Admin
        DB::table('users')->insert([
            'fname' => 'Heart',
            'lname' => 'Felt',
            'email' => 'heartfelt@gmail.com',
            'is_admin' => '1',
            'password' => Hash::make('password1234'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
