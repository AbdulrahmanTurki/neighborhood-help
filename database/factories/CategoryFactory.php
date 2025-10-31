<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Moving Help',
            'Tutoring & Education',
            'Pet Sitting/Walking',
            'Yard Work',
            'Technology Assistance',
            'Home Repairs',
            'Child Care',
            'Errands',
        ];

        return [
            // Ensure category name is unique
            'name' => fake()->unique()->words(2, true),
        ];
    }
}
