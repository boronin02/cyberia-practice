<?php

namespace Database\Factories;

use App\Models\Author;
use Database\Factories\Concerns\HandlesImages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Author>
 */
final class AuthorFactory extends Factory
{
    use HandlesImages;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'image' => $this->generateImageFromDirectory('authors', 'authors'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
