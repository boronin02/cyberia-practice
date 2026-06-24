<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Support\Filament\HasCreatePageConfig;
use Filament\Resources\Pages\CreateRecord;

final class CreateProject extends CreateRecord
{
    use HasCreatePageConfig;

    protected static string $resource = ProjectResource::class;
}
