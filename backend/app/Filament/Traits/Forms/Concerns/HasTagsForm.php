<?php

namespace App\Filament\Traits\Forms\Concerns;

use Filament\Forms\Components\Select;

trait HasTagsForm
{
    public static function getTagsFormComponent(): Select
    {
        return Select::make('tags')
            ->label(__('filament/post.fields.tags'))
            ->relationship('tags', 'name')
            ->preload()
            ->multiple();
    }
}
