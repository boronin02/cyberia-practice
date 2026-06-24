<?php

namespace App\Filament\Resources\AwardResource\Pages;

use App\Filament\Concerns\HasClearsResponseCache;
use App\Filament\Resources\AwardResource;
use App\Support\Filament\HasActions;
use Filament\Resources\Pages\ListRecords;

final class ListAwards extends ListRecords
{
    use HasActions, HasClearsResponseCache;

    protected static string $resource = AwardResource::class;

    protected function getHeaderActions(): array
    {
        return self::getBaseActions();
    }
}
