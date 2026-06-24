<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Sentry\Laravel\Integration;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
    )
    ->withSingletons([
        Illuminate\Contracts\Http\Kernel::class => App\Http\Kernel::class,
        Illuminate\Contracts\Console\Kernel::class => App\Console\Kernel::class,
        Illuminate\Contracts\Debug\ExceptionHandler::class => App\Exceptions\Handler::class,
    ])
    ->withExceptions(function (Exceptions $exceptions) {
        Integration::handles($exceptions);
    })
    ->create();
