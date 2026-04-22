<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

// Hapus 'extends Controller' agar tidak error "Class not found"
class DashboardController
{
    // 1. FUNGSI UNTUK HALAMAN DEPAN (DASHBOARD)
    public function index(Request $request)
    {
        // Query dasar produk
        $query = Product::query();

        // Logika Pencarian (Jika ada ketikan di kolom search)
        if ($request->has('query') && $request->input('query') != '') {
            $query->where('name', 'like', '%' . $request->input('query') . '%');
        }

        // Ambil produk terbaru
        $products = $query->latest()->get();
        
        // Ambil kategori untuk menu navbar (Penting agar tidak error "Undefined variable")
        $global_categories = Category::all();

        return view('dashboard.index', compact('products', 'global_categories'));
    }

    // 2. FUNGSI PENCARIAN (KHUSUS)
    public function search(Request $request)
    {
        $keyword = $request->input('query', '');
        
        $query = Product::query();
        
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        } else {
            $query->latest();
        }
        
        $products = $query->get();
        $global_categories = Category::all();
        
        return view('products.search', compact('products', 'keyword', 'global_categories'));
    }

    // 3. FUNGSI DETAIL PRODUK
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $global_categories = Category::all();

        return view('products.show', compact('product', 'global_categories'));
    }
}