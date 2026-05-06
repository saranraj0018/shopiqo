<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate  
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
    */

    protected function redirectTo($request): ?string
    {
         if (! $request->expectsJson()) {

            // Redirect for Admin users
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            // Default redirect for other guests
            return route('admin.login');  // If you don't have public login, you may remove this
        }

        return null;
    }
}
