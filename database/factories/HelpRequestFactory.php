<?php

namespace Database\Factories;

use App\Models\HelpRequest;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HelpRequest>
 */
class HelpRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HelpRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['request', 'offer']);

        if ($type === 'request') {
            $titles = [
                'Need help moving furniture this weekend.',
                'Looking for someone to fix a leaky faucet.',
                'Need dog walker for two weeks.',
                'Can anyone assist with assembling IKEA shelf?',
            ];
        } else {
            $titles = [
                'Offering free coding lessons.',
                'Local handyman available for small jobs.',
                'Free pet sitting for neighborhood dogs.',
                'Offering rides to the grocery store.',
            ];
        }

        return [
            
            'user_id' => User::factory(),
            
            'category_id' => Category::factory(), 

            
            'title' => fake()->randomElement($titles),
            'body' => fake()->paragraph(5),
            
            'type' => $type,
            'status' => fake()->randomElement(['open', 'in_progress', 'completed']),
        ];
    }
}
