<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use App\Support\Filament\HasCreatePageConfig;
use Filament\Resources\Pages\CreateRecord;

final class CreateBanner extends CreateRecord
{
    use HasCreatePageConfig;

    protected static string $resource = BannerResource::class;
}
