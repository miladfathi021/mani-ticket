<?php

namespace App\Exceptions;

use Exception;

class AuthenticationException extends Exception
{
    public function render() : \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => 'Unauthenticated.',
        ], 401);
    }
}
