<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu');
        }

        // Cek apakah user adalah regular user
        // if (Auth::user()->role !== 'user') {
        //     return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak! Halaman ini khusus user.');
        // }

        return $next($request);
    }
}