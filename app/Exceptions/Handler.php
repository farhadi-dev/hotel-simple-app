<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
        'current_password',
    ];

    public function register(): void
    {
        $this->renderable(function (RepositoryException $e, $request) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 500);
        });

        $this->renderable(function (ValidationException $e, $request) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'details' => $e->errors(),
            ], 422);
        });
    }
}
