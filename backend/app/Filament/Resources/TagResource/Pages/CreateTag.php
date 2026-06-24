<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use App\Support\Filament\HasCreatePageConfig;
use Filament\Resources\Pages\CreateRecord;

final class CreateTag extends CreateRecord
{
    use HasCreatePageConfig;

    protected static string $resource = TagResource::class;
}
