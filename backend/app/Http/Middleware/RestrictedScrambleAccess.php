<?php

namespace App\Http\Middleware;

use Closure;
use Dedoc\Scramble\Http\Middleware\RestrictedDocsAccess;

final class RestrictedScrambleAccess extends RestrictedDocsAccess
{
    public function handle($request, Closure $next)
    {
        if (RestrictedScrambleAccess::isEnabled()) {
            return $next($request);
        }

        abort(403);
    }

    public static function isEnabled(): bool
    {
        return true;
    }
}
