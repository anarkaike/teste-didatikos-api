<?php

namespace App\Http\Middleware;

use App\Http\Responses\ApiErrorResponse;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        return $request->expectsJson() ? (new ApiErrorResponse(message: trans(key: 'auth.unauthenticated')))->toResponse() : route('login');
    }
}
