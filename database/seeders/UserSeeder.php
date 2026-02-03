<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'firstName' => Str::random(12),
            'lastName' => Str::random(15),
            'email' => Str::random(8) . '@' . Str::random(5) . '.com',
            'password' => Hash::make('password'),
            'isAllowed' => 1,
            'reputation' => mt_rand(1, 99),
            'roles' => 'User',
            'createdAt'=> new DateTime()
        ]);
    }
}
