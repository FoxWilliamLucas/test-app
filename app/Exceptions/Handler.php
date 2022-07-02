<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Helpers\{Response, ResponseStatus};
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\{
    NotFoundHttpException,
    AccessDeniedHttpException,
    MethodNotAllowedHttpException,
};

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        if(request()->wantsJson()){
            $this->renderable(function (MethodNotAllowedHttpException $exception, $request) {
                return Response::respondError(Response::NOT_ALLOWED,ResponseStatus::NOT_ALLOWED);
            });
            $this->renderable(function (NotFoundHttpException $exception, $request) {
                return Response::respondError(Response::NOT_FOUND, ResponseStatus::NOT_FOUND);
            });
            $this->renderable(function (ModelNotFoundException $exception, $request) {
                return Response::respondError(Response::NOT_FOUND, ResponseStatus::NOT_FOUND);
            });
            $this->renderable(function (AccessDeniedHttpException $exception, $request) {
                return Response::respondError(Response::NOT_AUTHORIZED,ResponseStatus::FORBIDDEN);
            });
            $this->renderable(function (AuthenticationException $exception, $request) {
                return Response::respondError(Response::NOT_AUTHENTICATED,ResponseStatus::NETWORK_AUTHENTICATION_REQUIRED);
            });
            $this->renderable(function (ValidationException $exception, $request) {
                return Response::respondError($exception->getMessage(),ResponseStatus::VALIDATION_ERROR);
            });            
        }
    }
}
