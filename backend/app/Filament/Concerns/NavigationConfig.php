<?php

namespace App\Filament\Concerns;

use App\Filament\Resources\AuthorResource;
use App\Filament\Resources\AwardResource;
use App\Filament\Resources\BannerResource;
use App\Filament\Resources\PositionResource;
use App\Filament\Resources\PostResource;
use App\Filament\Resources\ProjectCategoryResource;
use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\ReviewResource;
use App\Filament\Resources\TagResource;
use Filament\Pages\SubNavigationPosition;

class NavigationConfig
{
    public static function navigationSort(string $class): ?int
    {
        return match ($class) {
            AuthorResource::class => 1,
            PositionResource::class => 2,
            PostResource::class => 3,
            TagResource::class => 4,

            ProjectCategoryResource::class => 1,
            ProjectResource::class => 2,
            ReviewResource::class => 3,

            AwardResource::class => 1,
            BannerResource::class => 2,

            default => null,
        };
    }

    public static function navigationGroup(string $class): ?string
    {
        return match ($class) {
            AuthorResource::class,
            PositionResource::class,
            PostResource::class,
            TagResource::class => __('filament/navigation.blog'),

            ProjectCategoryResource::class,
            ProjectResource::class,
            ReviewResource::class => __('filament/navigation.projects'),

            AwardResource::class,
            BannerResource::class => __('filament/navigation.content'),

            default => null,
        };
    }

    public static function navigationIcon(string $class): ?string
    {
        return match ($class) {
            AuthorResource::class => 'heroicon-o-user-group',
            PositionResource::class => 'heroicon-o-star',
            PostResource::class => 'heroicon-o-newspaper',
            TagResource::class => 'heroicon-o-tag',

            ProjectCategoryResource::class => 'heroicon-o-rectangle-stack',
            ProjectResource::class => 'heroicon-o-command-line',
            ReviewResource::class => 'heroicon-o-chat-bubble-left',

            BannerResource::class => 'heroicon-o-photo',

            AwardResource::class => 'heroicon-o-bolt',

            default => 'heroicon-c-bars-4',
        };
    }

    public static function cluster(string $class): ?string
    {
        return null;
    }

    public static function recordTitleAttribute(string $class): ?string
    {
        return null;
    }

    public static function subNavigationPosition(string $class): SubNavigationPosition
    {
        return SubNavigationPosition::Top;
    }
}
