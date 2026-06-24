<?php

namespace App\Support\Mixins;

use Closure;
use Filament\Forms\Components\Concerns\HasPlaceholder;
use Filament\Support\Components\Component;
use Illuminate\Support\Str;

/**
 * @mixin Component
 */
final class ComponentMixin
{
    public function translate(): Closure
    {
        return function (string $model, bool $transPlaceholder = true, bool $snake = false) {
            if (method_exists($this, 'getName')) {
                $name = $this->getName();

                if ($snake) {
                    $name = Str::replace('.', '_', $name);
                }

                if (method_exists($this, 'label')) {
                    $this->label(__("{$model}.common.{$name}"));
                }

                if (in_array(HasPlaceholder::class, class_uses_recursive($this), true)) {
                    $this->placeholder(__("{$model}.placeholder.{$name}"));
                }
            }

            return $this;
        };
    }
}
