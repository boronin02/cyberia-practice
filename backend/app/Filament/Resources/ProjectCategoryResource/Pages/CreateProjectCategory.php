<?php

namespace App\Filament\Resources\ProjectCategoryResource\Pages;

use App\Filament\Resources\ProjectCategoryResource;
use App\Support\Filament\HasCreatePageConfig;
use Filament\Resources\Pages\CreateRecord;

final class CreateProjectCategory extends CreateRecord
{
    use HasCreatePageConfig;

    protected static string $resource = ProjectCategoryResource::class;
}
