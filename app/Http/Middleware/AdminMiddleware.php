<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
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

        // Cek apakah user adalah admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('obat.index')->with('error', 'Akses ditolak! Anda bukan admin.');
        }

        return $next($request);
    }
}