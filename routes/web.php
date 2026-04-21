<?php

use Illuminate\Support\Facades\Route;

// --- 1. IMPORT CONTROLLER FRONT-END (USER) ---
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Front\PageController; // Controller Halaman Footer

// --- 2. IMPORT CONTROLLER BREEZE (AUTH) ---
use App\Http\Controllers\ProfileController;

// --- 3. IMPORT CONTROLLER ADMIN ---
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ====================================================
// A. RUTE PUBLIK (Bisa Diakses Tanpa Login)
// ====================================================

// 1. Halaman Utama
Route::get('/', [DashboardController::class, 'index'])->name('home');

// 2. Fitur Search
Route::get('/search', [DashboardController::class, 'search'])->name('products.search');

// 3. Halaman Kategori
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::get('/kategori/{slug}', [KategoriController::class, 'show'])->name('kategori.show');

// 4. Detail Produk
Route::get('/product/{slug}', [DashboardController::class, 'show'])->name('products.show');

// 5. Keranjang Belanja (Group)
Route::controller(KeranjangController::class)->group(function () {
    Route::get('/keranjang', 'index')->name('keranjang');
    Route::post('/keranjang/add', 'addToCart')->name('keranjang.add'); 
    Route::patch('/keranjang/update', 'update')->name('keranjang.update');
    Route::delete('/keranjang/remove', 'remove')->name('keranjang.remove');
});

// 6. Halaman Statis (Footer: FAQ, Kontak, dll)
Route::controller(PageController::class)->group(function() {
    Route::get('/faq', 'faq')->name('page.faq');
    Route::get('/cara-pemesanan', 'howToOrder')->name('page.howToOrder');
    Route::get('/lokasi-toko', 'location')->name('page.location');
    Route::get('/hubungi-kami', 'contact')->name('page.contact');
});

// 7. Notifikasi (Opsional)
Route::get('/notifikasi', function () {
    return view('notifikasi.index');
})->name('notifikasi');


// ====================================================
// B. RUTE AUTH (Wajib Login)
// ====================================================

Route::middleware(['auth'])->group(function () {
    
    // 1. Dashboard Redirect (Memilah Admin vs User)
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') { // Gunakan === untuk keamanan
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    })->middleware(['verified'])->name('dashboard');

    // 2. Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.store');

    // 3. User Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


// ====================================================
// C. RUTE ADMIN PANEL (Hanya Role Admin)
// ====================================================



Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    
    // 1. Dashboard Admin
   Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard'); // <-- INI WAJIB ADA
    Route::get('/dashboard/report', [AdminDashboardController::class, 'downloadReport'])->name('dashboard.report'); // <-- INI FITUR DOWNLOA
    // 2. Manajemen Kategori & Produk
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    // 3. Manajemen User
    Route::resource('users', UserController::class);

    // 4. Manajemen Pesanan
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

}); 


// ====================================================
// D. FILE AUTH (Register, Login, Logout, Reset Password)
// ====================================================
// Jangan hapus baris ini, ini memanggil routes/auth.php
require __DIR__.'/auth.php';