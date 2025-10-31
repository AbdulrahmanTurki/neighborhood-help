<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\HelpRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           
            'user_id' => User::factory(),
            'help_request_id' => HelpRequest::factory(),

            
            'body' => fake()->realText(150),
        ];
    }
}
