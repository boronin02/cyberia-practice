<?php

namespace App\Filament\Traits;

/**
 * @deprecated Use `App\Support\Filament\HasTranslation`.
 */
trait HasResourceTranslation
{
    public static function getNavigationLabel(): string
    {
        return self::getPluralLabel();
    }

    public static function getPluralLabel(): string
    {
        return __('filament/' . static::getTranslateModelName() . '.label.plural');
    }

    abstract public static function getTranslateModelName(): string;

    public static function getModelLabel(): string
    {
        return self::label();
    }

    public static function label(): string
    {
        return __('filament/' . static::getTranslateModelName() . '.label.model');
    }

    public static function getBreadcrumb(): string
    {
        return self::getPluralLabel();
    }
}
