<?php

namespace App\Support\Filament;

trait HasCreatePageConfig
{
    public function getTitle(): string
    {
        return self::getResource()::transFor('label.create');
    }
}
