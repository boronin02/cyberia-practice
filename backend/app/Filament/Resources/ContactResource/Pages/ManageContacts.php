<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Concerns\HasClearsResponseCache;
use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageContacts extends ManageRecords
{
    use HasClearsResponseCache;

    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
