<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use App\Models\Tag;
use App\Support\Filament\HasActions;
use App\Support\Filament\HasEditPageConfig;
use Filament\Resources\Pages\EditRecord;

final class EditTag extends EditRecord
{
    use HasActions, HasEditPageConfig;

    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return self::getBaseActions(list: ['delete'], callbacks: [
            'delete' => [
                'disabled' => static function (Tag $record) {
                    return $record->posts_exists;
                },
            ],
        ]);
    }
}
