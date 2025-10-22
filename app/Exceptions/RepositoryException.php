<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class RepositoryException extends Exception
{
    protected int $statusCode;

    public function __construct(string $message = 'Repository Error', int $statusCode = 500)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => $this->message,
        ], $this->statusCode);
    }
}
