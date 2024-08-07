<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'project_name' => $this->faker->text(),
            'project_description' => $this->faker->text(),
            'original_language' => $this->faker->text(),
            'target_language' => $this->faker->text(),
            'project_domain' => $this->faker->text(),
            'project_start_date' => $this->faker->dateTime(),
            'project_end_date' => $this->faker->dateTime('after_or_equal:project_start_date'),
            'project_budget' => $this->faker->numberBetween(1, 1000),
            'project_status' => $this->faker->randomElement(['Pending', 'Completed', 'In Progress']),
            'editing_proofreading_allowed' => $this->faker->boolean(),
            'bidding_allowed' => $this->faker->boolean(),

            'slug' => $this->faker->unique()->slug(),
            'user_id' => \App\Models\User::factory(),

        ];
    }
}
