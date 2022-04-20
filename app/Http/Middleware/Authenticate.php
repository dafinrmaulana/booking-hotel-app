<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
<<<<<<< HEAD
            return route('login');
=======
            return route('auth.index');
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
        }
    }
}
