<?php

namespace Database\Factories;

use App\Enums\Media\MediaCollectionType;
use App\Models\Project;
use Database\Factories\Concerns\HandlesImages;
use Database\Factories\Concerns\HasImagesFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;

/**
 * @extends Factory<Project>
 */
final class ProjectFactory extends Factory
{
    use HandlesImages, HasImagesFactory;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->unique()->slug(),
            'title' => $this->faker->realText(rand(10, 30), true),
            'description' => $this->faker->realText(80),
            'price' => $this->faker->numberBetween(500000, 3000000),
            'time' => $this->faker->randomElement(['3 месяца', '4 месяца', '5 месяцев', '6 месяцев', '8 месяцев', '12 месяцев']),
            'link' => $this->faker->url(),
            'content' => $this->faker->boolean(40) ? $this->generateProjectContent() : null,
            'is_big' => $this->faker->boolean(30),
            'show_on_home' => $this->faker->boolean(40),
            'order' => $this->faker->numberBetween(1, 20),
            'home_order' => $this->faker->numberBetween(1, 20),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
            'project_category_id' => null,
        ];
    }

    public function withMedia(): self
    {
        return $this->afterCreating(function (HasMedia $model) {
            $this->attachImage($model, MediaCollectionType::ProjectImage);

            if ($this->faker->boolean(50)) {
                $this->attachImage($model, MediaCollectionType::ProjectImageMobile);
            }
        });
    }

    private function generateProjectContent(): array
    {
        $content = [];

        $content[] = [
            'type' => 'paragraph',
            'data' => [
                'content' => '<h1>' . $this->faker->realText(40) . '</h1><h2>' . $this->faker->realText(80) . '</h2>',
            ],
        ];

        if ($this->faker->boolean(70)) {
            $content[] = [
                'type' => 'image',
                'data' => [
                    'image' => $this->generateImageFromDirectory('random', 'projects'),
                ],
            ];
        }

        $content[] = [
            'type' => 'paragraph',
            'data' => [
                'content' => '<h2>О проекте</h2><p>' . $this->faker->realText(600) . '</p>',
            ],
        ];

        if ($this->faker->boolean(50)) {
            $content[] = [
                'type' => 'paragraph',
                'data' => [
                    'content' => '<h2>Проблематика и цели</h2><p>' . $this->faker->realText(400) . '</p>',
                ],
            ];
        }

        if ($this->faker->boolean(60)) {
            $content[] = [
                'type' => 'image',
                'data' => [
                    'image' => $this->generateImageFromDirectory('random', 'projects'),
                ],
            ];
        }

        $content[] = [
            'type' => 'paragraph',
            'data' => [
                'content' => '<h2>Результаты</h2><p>' . $this->faker->realText(400) . '</p>',
            ],
        ];

        return $content;
    }

    public function withContent(): self
    {
        return $this->state(fn(array $attributes) => [
            'content' => json_decode('[{"data": {"content": "<h1>H1</h1><p>paragraph</p>"}, "type": "paragraph"}]', true),
        ]);
    }

    public function related(Project $project): self
    {
        return $this->state(fn(array $attributes) => [
            'project_category_id' => $project->project_category_id,
        ]);
    }

    public function deleted(): self
    {
        return $this->state(fn(array $attributes) => [
            'deleted_at' => Carbon::now(),
        ]);
    }
}
