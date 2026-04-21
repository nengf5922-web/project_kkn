<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

// PERBAIKAN: Hapus 'extends Controller' agar tidak error
class KategoriController
{
    // Menampilkan halaman semua kategori (jika ada)
    public function index()
    {
        // Ambil semua kategori untuk menu navbar (jika layout memerlukannya)
        // $global_categories = Category::all(); 
        
        $categories = Category::all();
        return view('kategori.index', compact('categories'));
    }

    // Menampilkan produk berdasarkan kategori tertentu
    public function show($slug)
    {
        // 1. Cari kategori berdasarkan slug yang diklik
        $category = Category::where('slug', $slug)->firstOrFail();

        // 2. Cari produk yang punya kategori tersebut
        $products = Product::where('category_id', $category->id)->get();
        
        // Tambahan: Ambil global categories agar navbar tidak error (jika pakai layout utama)
        $global_categories = Category::all();

        // 3. Kirim variabel ke View
        return view('kategori.show', compact('category', 'products', 'global_categories'));
    }
}