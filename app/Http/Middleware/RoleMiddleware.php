<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user(); // ambil user yang login

        // Kalau belum login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Kalau role tidak sesuai
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized: Anda tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}
