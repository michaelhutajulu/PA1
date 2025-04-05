<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        // Admin dicek dari email
        if (Auth::check() && Auth::user()->email === 'admin@bintangserasi.com') {
            return $next($request);
        }

        abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses.');
    }
}
