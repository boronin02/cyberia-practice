<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Support\Filament\HasActions;
use App\Support\Filament\HasEditPageConfig;
use Filament\Resources\Pages\EditRecord;

final class EditProject extends EditRecord
{
    use HasActions, HasEditPageConfig;

    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return self::getBaseActions(list: ['delete', 'force_delete', 'restore']);
    }
}
