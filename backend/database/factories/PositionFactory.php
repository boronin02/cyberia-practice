<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Position>
 */
final class PositionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->jobTitle(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
