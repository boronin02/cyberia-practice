<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Concerns\HasClearsResponseCache;
use App\Filament\Resources\TagResource;
use App\Support\Filament\HasActions;
use Filament\Resources\Pages\ListRecords;

final class ListTags extends ListRecords
{
    use HasActions, HasClearsResponseCache;

    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return self::getBaseActions();
    }
}
