<?php

namespace App\Support\Filament;

trait HasTranslation
{
    use HasLang;

    abstract public static function getTranslateModelName(): string;

    public static function trans(
        array  $items,
        bool   $transPlaceholder = true,
        string $additional = '',
        bool   $doSnake = false,
    ): array {
        $model = static::getTranslateModelName() . $additional;

        return collect($items)
            ->each(static function ($item) use ($model, $transPlaceholder, $doSnake) {
                if (method_exists($item, 'getChildComponents')) {
                    self::trans(
                        items: $item->getChildComponents(),
                        transPlaceholder: $transPlaceholder,
                        doSnake: $doSnake
                    );
                }

                $item->translate($model, $transPlaceholder, $doSnake);
            })
            ->toArray();
    }

    public static function transFor(string $item, array $replace = []): string
    {
        return __(static::getTranslateModelName() . '.' . $item, $replace);
    }

    public static function transChoiceFor(string $item, int $number, array $replace = []): string
    {
        return trans_choice(static::getTranslateModelName() . '.' . $item, $number, $replace);
    }

    public static function getPluralModelLabel(): string
    {
        return static::getModelLabel();
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return static::getPluralModelLabel();
    }

    public static function getModelLabel(): string
    {
        return __(static::getTranslateModelName() . '.label.main');
    }

    public static function getTitle($ownerRecord, string $pageClass): string
    {
        return static::getModelLabel();
    }

    public static function hasTitleCaseModelLabel(): bool
    {
        return false;
    }
}
