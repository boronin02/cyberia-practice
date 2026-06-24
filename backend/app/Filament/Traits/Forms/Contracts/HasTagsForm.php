<?php

namespace App\Filament\Traits\Forms\Contracts;

use Filament\Forms\Components\Select;

interface HasTagsForm
{
    public static function getTagsFormComponent(): Select;
}
