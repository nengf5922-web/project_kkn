<?php

namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller; // Hapus ini karena tidak dipakai
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

// PERBAIKAN: Hapus 'extends Controller'
class AuthenticatedSessionController
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Lakukan proses login (Validasi ada di LoginRequest)
        $request->authenticate();

        // 2. Buat ulang session (Security)
        $request->session()->regenerate();

        // 3. LOGIKA REDIRECT BERDASARKAN ROLE
        // Pastikan kolom 'role' ada di tabel users Anda
        if ($request->user()->role === 'admin') {
            // Jika Admin, arahkan ke dashboard admin
            // Pastikan route 'admin.dashboard' sudah didefinisikan di web.php
            return redirect()->intended(route('dashboard')); 
        }

        // Jika User Biasa, arahkan ke halaman utama (Home)
        return redirect()->intended(route('home'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}