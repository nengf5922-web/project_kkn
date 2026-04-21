<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika user login DAN perannya 'admin'
        if ($request->user() && $request->user()->role == 'admin') {
            return $next($request); // Lanjutkan
        }

        // Jika tidak, tendang ke halaman utama
        return redirect('/');
    }
}