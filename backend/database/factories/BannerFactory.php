<?php

namespace Database\Factories;

use App\Enums\Media\MediaCollectionType;
use App\Models\Banner;
use Database\Factories\Concerns\HasImagesFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;

/**
 * @extends Factory<Banner>
 */
final class BannerFactory extends Factory
{
    use HasImagesFactory;

    public function definition(): array
    {
        return [
            'title' => $this->faker->realText(40),
            'description' => $this->faker->realText(200),
            'order' => $this->faker->numberBetween(1, 10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function withMedia(): self
    {
        return $this->afterCreating(function (HasMedia $model) {
            $this->attachImage($model, MediaCollectionType::BannerDesktop);
            $this->attachImage($model, MediaCollectionType::BannerMobile);
        });
    }
}
