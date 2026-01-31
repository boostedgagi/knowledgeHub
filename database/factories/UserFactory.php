<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{

    protected static function run()
    {
        User::factory()->count(20)->make();
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstName' => fake()->name(),
            'lastName' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'isAllowed' => fake()->boolean,
            'reputation' => fake()->numberBetween(1, 99),
            'roles' => fake()->word,
            'createdAt' => fake()->dateTime
        ];
    }
}
