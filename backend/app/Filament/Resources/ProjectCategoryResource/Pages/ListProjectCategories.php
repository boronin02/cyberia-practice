<?php

namespace App\Filament\Resources\ProjectCategoryResource\Pages;

use App\Filament\Concerns\HasClearsResponseCache;
use App\Filament\Resources\ProjectCategoryResource;
use App\Support\Filament\HasActions;
use Filament\Resources\Pages\ListRecords;

final class ListProjectCategories extends ListRecords
{
    use HasActions, HasClearsResponseCache;

    protected static string $resource = ProjectCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return self::getBaseActions();
    }
}
