<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('posts')->insert([
            'content' => Str::random(50),
            'upVotes' => 25,
            'downVotes' => 5,
            'categoryId' => 1,
            'userId'=>1
        ]);
    }

}
