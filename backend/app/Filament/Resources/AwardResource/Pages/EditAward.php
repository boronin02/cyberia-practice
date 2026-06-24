<?php

namespace App\Filament\Resources\AwardResource\Pages;

use App\Filament\Resources\AwardResource;
use App\Support\Filament\HasActions;
use App\Support\Filament\HasEditPageConfig;
use Filament\Resources\Pages\EditRecord;

final class EditAward extends EditRecord
{
    use HasActions, HasEditPageConfig;

    protected static string $resource = AwardResource::class;

    protected function getHeaderActions(): array
    {
        return self::getBaseActions(list: ['delete']);
    }
}
