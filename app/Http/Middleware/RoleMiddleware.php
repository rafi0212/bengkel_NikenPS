<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->status_pekerjaan !== $role) {
            return redirect('/');  // Redirect ke halaman utama jika role tidak sesuai
        }

        return $next($request);
    }
}

