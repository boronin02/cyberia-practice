<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Concerns\HasClearsResponseCache;
use App\Filament\Resources\BannerResource;
use App\Support\Filament\HasActions;
use Filament\Resources\Pages\ListRecords;

final class ListBanners extends ListRecords
{
    use HasActions, HasClearsResponseCache;

    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return self::getBaseActions();
    }
}
