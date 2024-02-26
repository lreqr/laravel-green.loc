<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GreenListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->paragraph(1),
            'company' => fake()->company(),
            'tags' => 'Laravel, Api, Backend',
            'location' => fake()->country(),
            'description' => fake()->paragraph(2),
            'email' => fake()->companyEmail(),
            'website' => fake()->url(),
            'votes' => fake()->randomDigit(),
        ];
    }
}
