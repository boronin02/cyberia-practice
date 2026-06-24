<?php

namespace App\Filament\Resources\AwardResource\Pages;

use App\Filament\Resources\AwardResource;
use App\Support\Filament\HasCreatePageConfig;
use Filament\Resources\Pages\CreateRecord;

final class CreateAward extends CreateRecord
{
    use HasCreatePageConfig;

    protected static string $resource = AwardResource::class;
}
