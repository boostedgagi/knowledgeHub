<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title'=>fake()->name(),
            'postContent'=> fake()->text(80),
            'upVotes'=>fake()->numberBetween(10,20),
            'downVotes'=>fake()->numberBetween(5,15),
            'categoryId'=>Category::inRandomOrder()->first()->id,
            'userId'=>User::inRandomOrder()->first()->id,
            'createdAt'=>Carbon::now()->format('Y-m-d H:i:s')
        ];
    }
}
