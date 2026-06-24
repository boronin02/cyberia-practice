<?php

namespace Database\Factories\Concerns;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait HandlesImages
{
    private function generateImageFromDirectory(string $sourceDirectory, string $targetDirectory): string
    {
        $sourceDir = resource_path("seeders/images/{$sourceDirectory}");
        $targetDir = storage_path("app/public/{$targetDirectory}");

        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $images = File::files($sourceDir);

        if (empty($images)) {
            return '';
        }

        $randomImage = $this->faker->randomElement($images);
        $extension = $randomImage->getExtension();

        $uniqueName = Str::uuid() . '.' . $extension;
        $targetPath = $targetDir . '/' . $uniqueName;

        File::copy($randomImage->getPathname(), $targetPath);

        return "{$targetDirectory}/{$uniqueName}";
    }
}
