<?php

namespace Pkg\WebApp\v1\Helpers;

use Illuminate\Support\Facades\URL;
use Throwable;

class Boilerplate
{
    public static function callSentry(Throwable $e): void
    {
        if (
            config('sentry.environment', 'local') !== 'local' && app()->bound('sentry')) {
            app('sentry')->captureException($e);
        }
    }

    public static function resolveAppSchema(string $appUrl): string
    {
        return str_contains($appUrl, 'https://')
            ? 'https'
            : 'http';
    }

    public static function enforceAppSchema(): void
    {
        /**
         * @var string $appUrl
         */
        $appUrl = config('app.url', 'http://localhost');

        $schema = str_contains($appUrl, 'https://')
            ? 'https'
            : 'http';

        URL::forceScheme($schema);
    }

    public static function enforceForwardedProto(): void
    {
        /**
         * @var string $appUrl
         */
        $appUrl = config('app.url', 'http://localhost');

        // Filament file upload will not work without this
        if (preg_match('/^https:\/\//m', $appUrl)) {
            $param = request()->header('X-Forwarded-Proto', 'https') === 'https'
                ? 'on'
                : 'off';

            request()
                ->server
                ->set('HTTPS', $param);
        }
    }
}
