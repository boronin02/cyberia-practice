<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Post;
use Database\Factories\Concerns\HandlesImages;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
final class PostFactory extends Factory
{
    use HandlesImages;

    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => fake()->realText(40),
            'description' => fake()->boolean(70) ? fake()->realText(120) : null,
            'slug' => fake()->unique()->slug(),
            'image' => $this->generateImageFromDirectory('random', 'posts'),
            'image_preview' => $this->generateImageFromDirectory('random', 'posts'),
            'content' => $this->generateContent(),
            'is_published' => fake()->boolean(80),
            'is_news' => fake()->boolean(50),
            'is_popular' => fake()->boolean(30),
            'published_at' => fake()->optional(0.8)->dateTimeBetween('-1 year', '-1 day'),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }

    public function published(): self
    {
        return $this->state(fn(array $attributes) => [
            'is_published' => true,
            'published_at' => fake()->dateTimeBetween('-1 year', '-1 day'),
        ]);
    }

    public function notPublished(): self
    {
        return $this->state(fn(array $attributes) => [
            'is_published' => false,
            'published_at' => fake()->dateTimeBetween('1 day', '1 year'),
        ]);
    }

    public function news(): self
    {
        return $this->state(fn(array $attributes) => [
            'is_news' => true,
        ]);
    }

    public function blog(): self
    {
        return $this->state(fn(array $attributes) => [
            'is_news' => false,
        ]);
    }

    public function popular(): self
    {
        return $this->state(fn(array $attributes) => [
            'is_popular' => true,
        ]);
    }

    public function withAuthors(int $count = 1): self
    {
        return $this->afterCreating(function (Post $post) use ($count) {
            $authors = Author::query()->inRandomOrder()->limit($count)->get();
            $post->authors()->attach($authors);
        });
    }

    private function generateContent(): array
    {
        $blocks = [];
        $blockCount = fake()->numberBetween(1, 5);

        for ($i = 0; $i < $blockCount; $i++) {
            $type = fake()->randomElement(['paragraph', 'image']);

            $blocks[] = match ($type) {
                'paragraph' => [
                    'type' => 'paragraph',
                    'data' => [
                        'content' => '<p>' . fake()->realText(500) . '</p>',
                    ],
                ],
                'image' => [
                    'type' => 'image',
                    'data' => [
                        'image' => $this->generateImageFromDirectory('random', 'posts'),
                    ],
                ],
            };
        }

        return $blocks;
    }
}
