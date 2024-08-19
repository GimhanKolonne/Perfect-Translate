<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => $this->faker->randomDigitNotNull,
            'user_id' => $this->faker->randomDigitNotNull,
            'application_message' => $this->faker->text,
            'cv_path' => $this->faker->word,
            'contact_email' => $this->faker->safeEmail,
            'contact_phone' => $this->faker->phoneNumber,
            'language_proficiency' => $this->faker->word,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'slug' => $this->faker->unique()->word,
        ];
    }
}
