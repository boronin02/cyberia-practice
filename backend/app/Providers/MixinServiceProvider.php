<?php

namespace App\Providers;

use App\Support\Mixins\ComponentMixin;
use Filament\Support\Components\Component;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Traits\Macroable;
use ReflectionException;

final class MixinServiceProvider extends ServiceProvider
{
    protected array $mixins = [
        Component::class => ComponentMixin::class,
    ];

    /**
     * @throws ReflectionException
     */
    public function boot(): void
    {
        /** @var class-string<Macroable> $class */
        foreach ($this->mixins as $class => $mixin) {
            $class::mixin(new $mixin);
        }
    }
}
