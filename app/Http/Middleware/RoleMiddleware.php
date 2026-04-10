<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // cek login dulu
        if (!auth()->check()) {
            return redirect('/login');
        }

        //  cek role
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Akses ditolak!');
        }

        return $next($request);
    }
}