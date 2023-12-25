<?php

namespace App\Exceptions;
use App\Traits\HttpResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use HttpResponse;
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
            //
        });
    }

    public function render($request, Throwable $exception)
    {

        if ($exception instanceof ValidationFailedException) {
            return $this->error(
                'Validation Failed',
                json_decode($exception->getMessage()),
            );
        }

        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->error(
                'Not Found',
                $exception->getMessage(),
                404
            );
        }

        if ($exception instanceof AuthorizationException) {
            return $this->error(
                'Unauthorized',
                $exception->getMessage(),
                403
            );
        }

        if ($exception instanceof AuthenticationException) {
            return response([
                'message' => 'You are unauthenticated.'
            ], 401);
        }

        return parent::render($request, $exception);
    }
}
