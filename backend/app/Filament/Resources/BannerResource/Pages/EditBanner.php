<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use App\Support\Filament\HasActions;
use App\Support\Filament\HasEditPageConfig;
use Filament\Resources\Pages\EditRecord;

final class EditBanner extends EditRecord
{
    use HasActions, HasEditPageConfig;

    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return self::getBaseActions(list: ['delete']);
    }
}
