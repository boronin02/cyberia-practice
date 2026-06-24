<?php

namespace App\Filament\Resources\PositionResource\Pages;

use App\Filament\Concerns\HasClearsResponseCache;
use App\Filament\Resources\PositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePositions extends ManageRecords
{
    use HasClearsResponseCache;

    protected static string $resource = PositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
