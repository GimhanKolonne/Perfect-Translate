<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'contact_name' => $this->faker->name,
            'contact_phone' => $this->faker->phoneNumber,
            'company_address' => $this->faker->address,
            'country' => $this->faker->country,
            'website' => $this->faker->url,
            'industry' => $this->faker->word,
            'bio' => $this->faker->paragraph,
            'slug' => $this->faker->slug,
            'user_id' => \App\Models\User::factory(),

        ];
    }
}
