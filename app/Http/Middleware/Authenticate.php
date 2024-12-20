<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $is_api_request = $request->route()->getPrefix();
        if ($is_api_request === 'api') {
            if (!$request->expectsJson()) {
                return route('no-auth');
            }
        } else {
            return $request->expectsJson() ? null : route('login');
        }
    }
}
