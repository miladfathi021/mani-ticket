<?php

namespace App\Exceptions;

use Exception;

class DatabaseQueryException extends Exception
{
    public function render() : \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => true,
            'message' => 'Query Exception',
        ], 401);
    }
}
