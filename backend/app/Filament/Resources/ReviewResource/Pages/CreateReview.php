<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use App\Support\Filament\HasCreatePageConfig;
use Filament\Resources\Pages\CreateRecord;

final class CreateReview extends CreateRecord
{
    use HasCreatePageConfig;

    protected static string $resource = ReviewResource::class;
}
