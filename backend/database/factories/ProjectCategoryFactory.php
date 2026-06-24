<?php

namespace Database\Factories;

use App\Models\ProjectCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<ProjectCategory>
 */
final class ProjectCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'order' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
