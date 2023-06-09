<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        if ($exception instanceof \App\Exceptions\CustomStoreException) {
            return $exception->report($exception);
        }

        if ($exception instanceof \App\Exceptions\CustomFindException) {
            return $exception->report($exception);
        }

        if ($exception instanceof \App\Exceptions\ApiException) {
            return $exception->report($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->is("api/*")) {
            if ($exception instanceof ValidationException) {
                return response()->json(
                    $exception->errors(),
                    $exception->status
                );
            }

            if ($exception instanceof RouteNotFoundException) {
                return response()->json([
                    'message' => 'Endpoint inválido'
                ]);
            }
        }
        return parent::render($request, $exception);
    }
}
