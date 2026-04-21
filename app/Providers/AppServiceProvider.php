<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

// --- IMPORT MODEL ---
use App\Models\Order;
use App\Models\Category; // <--- TAMBAHKAN INI

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Paginator::useBootstrap();

        // 1. Logic Notifikasi Pesanan (Admin) - YANG SUDAH ADA
        View::composer('layouts.admin', function ($view) {
            $count = 0;
            try { $count = Order::where('status', 'pending')->count(); } catch (\Exception $e) {}
            $view->with('pendingOrders', $count);
        });

        // 2. Logic Kategori Global (Front-End) - TAMBAHKAN INI
        // Agar variabel $global_categories bisa dipakai di Sidebar & Footer
        try {
            $categories = Category::all(); // Ambil semua kategori
            View::share('global_categories', $categories); // Bagikan ke SEMUA View
        } catch (\Exception $e) {
            // Fallback jika tabel belum ada (biar gak error pas migrate)
            View::share('global_categories', collect([])); 
        }
    }
}