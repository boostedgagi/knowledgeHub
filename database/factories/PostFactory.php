<?php

namespace Database\Factories;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    protected static function run()
    {
        Post::factory()->count(20)->make();
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content'=> fake()->name(),
            'upVotes'=>25,
            'downVotes'=>5,
            'categoryId'=>1,
            'userId'=>1,
            'createdAt'=>Carbon::now()->format('Y-m-d H:i:s')
        ];
    }
}
