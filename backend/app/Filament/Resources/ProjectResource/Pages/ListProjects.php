<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Concerns\HasClearsResponseCache;
use App\Filament\Resources\ProjectResource;
use App\Support\Filament\HasActions;
use Filament\Resources\Pages\ListRecords;

final class ListProjects extends ListRecords
{
    use HasActions, HasClearsResponseCache;

    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return self::getBaseActions();
    }
}
