<?php
namespace App\Http\Responses;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class ErrorResponse
{
    public static function validationError(Validator $validator): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => 'Validation failed',
            'errors'  => $validator->errors(),
        ], 422);
    }

  
}



