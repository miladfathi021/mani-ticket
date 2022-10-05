<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public function render() : \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => 'Given data is invalid.',
        ], 400);
    }
}
