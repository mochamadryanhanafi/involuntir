<?php

namespace App\Exceptions;

use App\Helpers\ApiResponseHelper;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

use Illuminate\Auth\Access\AuthorizationException;

class Handler extends ExceptionHandler
{
    
    protected $dontReport = [
        //
    ];

    
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    
    public function render($request, Throwable $e)
    {
        if ($request->is('api/*')) {
            if ($e instanceof AuthorizationException) {
                return ApiResponseHelper::sendError('This action is unauthorized.', [], 403);
            }

            if ($e instanceof ValidationException) {
                return ApiResponseHelper::sendError('Validation Error.', $e->errors(), 422);
            }

            return ApiResponseHelper::sendError('An unexpected error occurred.', [], 500);
        }

        return parent::render($request, $e);
    }
}
