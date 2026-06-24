<?php

namespace App\Services\ContentBuilder;

use App\Enums\ContentBuilder\ContentBuilderBlockEnum;
use App\Http\Resources\Author\AuthorResource;
use App\Models\Author;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

final class ContentService
{
    public function format(array $content): array
    {
        return Arr::map($content, function (array $block) {
            return self::formatBlock($block);
        });
    }

    private function formatBlock(array &$block): array
    {
        $type = Arr::get($block, 'type');

        match ($type) {
            ContentBuilderBlockEnum::IMAGE => self::formatImageBlock($block),
            ContentBuilderBlockEnum::IMAGE_TEXT => self::formatImageTextBlock($block),
            ContentBuilderBlockEnum::QUOTE => self::formatQuoteBlock($block),
            ContentBuilderBlockEnum::PROBLEMS_AND_GOALS => self::formatProblemsAndGoalsBlock($block),
            ContentBuilderBlockEnum::LITERACY => self::formatLiteracyBlock($block),
            ContentBuilderBlockEnum::QUOTE_ANOTHER_AUTHOR => self::formatQuoteAnotherAuthorBlock($block),
            default => null
        };

        return $block;
    }

    private static function formatImageBlock(array &$block): void
    {
        $image = Arr::get($block, 'data.image', '');

        $image = asset(Storage::url($image));

        Arr::set($block, 'data.image', $image);
    }

    private static function formatImageTextBlock(array &$block): void
    {
        $image = Arr::get($block, 'data.image', '');

        $image = asset(Storage::url($image));

        $backgroundColor = Arr::get($block, 'data.background_color');
        if (!$backgroundColor) {
            Arr::set($block, 'data.background_color', null);
        }

        Arr::set($block, 'data.image', $image);
    }

    private static function formatQuoteBlock(array &$block): void
    {
        $authorId = Arr::get($block, 'data.author_id');
        $backgroundImage = Arr::get($block, 'data.background_image', '');

        if ($backgroundImage) {
            $backgroundImage = asset(Storage::url($backgroundImage));
            Arr::set($block, 'data.background_image', $backgroundImage);
        }

        Arr::forget($block, 'data.author_id');

        $author = Author::find($authorId);

        Arr::set(
            $block,
            'data.author',
            $author
                ? (new AuthorResource($author))->toArray(request())
                : null
        );
    }

    private static function formatProblemsAndGoalsBlock(array &$block): void
    {
        $image = Arr::get($block, 'data.image', '');
        $backgroundImage = Arr::get($block, 'data.background_image');

        $image = asset(Storage::url($image));
        if ($backgroundImage) {
            $backgroundImage = asset(Storage::url($backgroundImage));
        }

        Arr::set($block, 'data.image', $image);
        Arr::set($block, 'data.background_image', $backgroundImage);
    }

    private static function formatLiteracyBlock(array &$block): void
    {
        $documentImage = Arr::get($block, 'data.document_image', '');
        $backgroundImage = Arr::get($block, 'data.background_image');

        $documentImage = asset(Storage::url($documentImage));
        if ($backgroundImage) {
            $backgroundImage = asset(Storage::url($backgroundImage));
        }

        Arr::set($block, 'data.document_image', $documentImage);
        Arr::set($block, 'data.background_image', $backgroundImage);
    }

    private static function formatQuoteAnotherAuthorBlock(array &$block): void
    {
        $avatar = Arr::get($block, 'data.avatar', '');
        $backgroundImage = Arr::get($block, 'data.background_image', '');

        $avatar = asset(Storage::url($avatar));
        $backgroundImage = asset(Storage::url($backgroundImage));

        Arr::set($block, 'data.avatar', $avatar);
        Arr::set($block, 'data.background_image', $backgroundImage);
    }
}
