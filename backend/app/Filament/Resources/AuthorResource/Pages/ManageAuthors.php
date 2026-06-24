<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use App\Filament\Concerns\HasClearsResponseCache;
use App\Filament\Resources\AuthorResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAuthors extends ManageRecords
{
    use HasClearsResponseCache;

    protected static string $resource = AuthorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalHeading(__('filament/author.actions.create.title')),
        ];
    }
}
