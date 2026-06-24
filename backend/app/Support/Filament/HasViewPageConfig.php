<?php

namespace App\Support\Filament;

trait HasViewPageConfig
{
    public function getTitle(): string
    {
        return $this->getResource()::transFor('label.view');
    }
}
