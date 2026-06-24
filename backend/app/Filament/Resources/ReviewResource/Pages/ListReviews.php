<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Concerns\HasClearsResponseCache;
use App\Filament\Resources\ReviewResource;
use App\Support\Filament\HasActions;
use Filament\Resources\Pages\ListRecords;

final class ListReviews extends ListRecords
{
    use HasActions, HasClearsResponseCache;

    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return self::getBaseActions();
    }
}
