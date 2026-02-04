<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'firstName' => 'Pepe',
            'lastName' => 'Zabac',
            'email' => 'pepe@zabac.com',
            'password' => 'pepezabac',
            'roles' => 'Administrator'
        ]);

        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
