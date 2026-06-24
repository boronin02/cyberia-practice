<?php

namespace App\Support\Filament;

trait HasLang
{
    public static function getLang(): string
    {
        return app()->getLocale();
    }
}
