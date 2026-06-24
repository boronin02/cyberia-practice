<?php

namespace App\Http\Middleware\FIlament;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

final class AdminPanelLocaleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        App::setLocale('ru');

        return $next($request);
    }
}
