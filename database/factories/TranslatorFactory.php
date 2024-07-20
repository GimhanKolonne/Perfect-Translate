<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translator>
 */
class TranslatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'type_of_translator' => $this->faker->word,
            'language_pairs' => $this->faker->word,
            'years_of_experience' => $this->faker->randomNumber(2),
            'rate_per_word' => $this->faker->randomFloat(2, 0, 999999.99),
            'rate_per_hour' => $this->faker->randomFloat(2, 0, 999999.99),
            'availability' => $this->faker->word,
            'bio' => $this->faker->text,
            'is_verified' => $this->faker->boolean,
            'slug' => $this->faker->unique()->word,
            'status' => $this->faker->boolean,
            'user_id' => \App\Models\User::factory()
        ];
    }
}
