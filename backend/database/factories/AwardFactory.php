<?php

namespace Database\Factories;

use App\Enums\Media\MediaCollectionType;
use App\Models\Award;
use Database\Factories\Concerns\HasImagesFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;

/**
 * @extends Factory<Award>
 */
final class AwardFactory extends Factory
{
    use HasImagesFactory;

    public function definition(): array
    {
        $awardTitles = [
            'Лучший веб-проект года',
            'Премия за инновации',
            'Награда за дизайн',
            'Лучшая разработка',
            'Приз зрительских симпатий',
            'Золотая медаль',
            'Диплом победителя',
            'Сертификат качества',
        ];

        return [
            'title' => $this->faker->randomElement($awardTitles),
            'description' => $this->faker->realText(120),
            'order' => $this->faker->numberBetween(1, 10),
            'project_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function withMedia(): self
    {
        return $this->afterCreating(function (HasMedia $model) {
            $this->attachImage($model, MediaCollectionType::AwardImage);
            $this->attachImage($model, MediaCollectionType::AwardIcon);
        });
    }
}
