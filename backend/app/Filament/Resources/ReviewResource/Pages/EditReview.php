<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use App\Support\Filament\HasActions;
use App\Support\Filament\HasEditPageConfig;
use Filament\Resources\Pages\EditRecord;

final class EditReview extends EditRecord
{
    use HasActions, HasEditPageConfig;

    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return self::getBaseActions(list: ['delete']);
    }
}
