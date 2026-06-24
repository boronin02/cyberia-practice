<?php

namespace Database\Factories\Concerns;

use App\Enums\Media\MediaCollectionType;
use Spatie\MediaLibrary\HasMedia;

trait HasImagesFactory
{
    protected function attachImage(HasMedia $model, MediaCollectionType $collection): void
    {
        $file = resource_path('seeders/images/random/banner.jpg');

        if (!file_exists($file)) {
            $images = glob(resource_path('seeders/images/random/*'));
            if (!empty($images)) {
                $file = $this->faker->randomElement($images);
            }
        }

        if (file_exists($file)) {
            $model->copyMedia($file)->toMediaCollection($collection->value);
        }
    }
}
