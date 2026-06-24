<?php

namespace App\Support\Filament;

trait HasListPageConfig
{
    public function getTitle(): string
    {
        return self::getResource()::transFor('label.main');
    }
}
