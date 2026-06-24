<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Concerns\HasClearsResponseCache;
use App\Filament\Resources\FeedbackResource;
use Filament\Resources\Pages\ManageRecords;

class ManageFeedback extends ManageRecords
{
    use HasClearsResponseCache;

    protected static string $resource = FeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
