<?php

namespace App\Filament\Resources\VacancyResource\Pages;

use App\Filament\Concerns\HasClearsResponseCache;
use App\Filament\Resources\VacancyResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVacancies extends ManageRecords
{
    use HasClearsResponseCache;

    protected static string $resource = VacancyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
