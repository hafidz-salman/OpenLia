<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectAfterLoginMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'dosen':
                return redirect()->route('dosen.dashboard');
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard');
            case 'petugas':
                return redirect()->route('petugas.dashboard');
            default:
                Auth::logout(); // Jika peran tidak dikenali, logout saja
                return redirect('/login');
        }
    }
}