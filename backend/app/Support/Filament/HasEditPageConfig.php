<?php

namespace App\Support\Filament;

trait HasEditPageConfig
{
    public function getTitle(): string
    {
        return self::getResource()::transFor('label.edit');
    }
}
