<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use Pkg\WebApp\v1\Helpers\Api;
use Pkg\WebApp\v1\Helpers\Boilerplate;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            Boilerplate::callSentry($e);
        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            if (App::isProduction()) {
                if ($e instanceof AuthorizationException) {
                    return Api::unauthorized();
                }
                if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
                    return Api::notFound();
                }
                if ($e instanceof AuthenticationException) {
                    return Api::unauthenticated();
                }
            }

            if ($e instanceof AuthorizationException) {
                return Api::unauthorized($e->getMessage(), $this->getTrace($e));
            }
            if ($e instanceof NotFoundHttpException) {
                return Api::notFound($e->getMessage(), $this->getTrace($e));
            }
            if ($e instanceof AuthenticationException) {
                return Api::unauthenticated($e->getMessage(), $this->getTrace($e));
            }
            if ($e instanceof ValidationException) {
                return Api::unprocessableEntity(Arr::collapse($e->errors())[0], $e->errors());
            }
            if ($e instanceof ModelNotFoundException) {
                return Api::notFound(__('api.base.not_found', []));
            }

            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            return match ($statusCode) {
                401 => Api::unauthenticated($e->getMessage(), $this->getTrace($e)),
                403 => Api::unauthorized($e->getMessage(), $this->getTrace($e)),
                404 => Api::notFound($e->getMessage(), $this->getTrace($e)),
                422 => Api::unprocessableEntity($e->getMessage(), $this->getTrace($e)),
                default => Api::response($e->getMessage(), $this->getTrace($e), $statusCode),
            };
        }

        return parent::render($request, $e);
    }

    protected function getTrace(Throwable $e): array
    {
        return App::hasDebugModeEnabled() ? $e->getTrace() : [];
    }
}
