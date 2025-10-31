<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Skill::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $skills = [
            'Basic Plumbing',
            'Dog Walking',
            'Math Tutoring',
            'Heavy Lifting',
            'Light Carpentry',
            'Gardening/Lawn Care',
            'Technical Support',
            'Babysitting',
        ];

        // We use 'unique()' here because a finite set of unique skill records must be created first.
        return [
            'name' => fake()->unique()->randomElement($skills),
        ];
    }
}