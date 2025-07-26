<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek jika peran pengguna tidak sesuai dengan peran yang diizinkan
        if (Auth::user()->role !== $role) {
            // Jika tidak sesuai, kembalikan halaman error 403 (Forbidden)
            abort(403, 'ANDA TIDAK MEMILIKI AKSES');
        }

        // Jika sesuai, lanjutkan request ke tujuan berikutnya
        return $next($request);
    }
}