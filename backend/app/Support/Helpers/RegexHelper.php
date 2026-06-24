<?php

namespace App\Support\Helpers;

final class RegexHelper
{
    /**
     * Формат rgba цвета.
     */
    public static function rgba(): string
    {
        return '/^rgba\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3}),\s*(\d*(?:\.\d+)?)\)$/';
    }
}
