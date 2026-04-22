<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; // Tambahkan ini agar Navbar tidak error

// PERBAIKAN: Hapus 'extends Controller'
class KeranjangController
{
    public function index()
    {
        // 1. Ambil data cart dari session
        $cart = session()->get('cart', []);
        
        // 2. Hitung total belanja
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 3. Ambil Kategori untuk Navbar (PENTING)
        // Tanpa ini, halaman keranjang akan error karena layout butuh variabel ini
        $global_categories = Category::all();

        // 4. Kirim variable ke view
        return view('keranjang.index', compact('cart', 'total', 'global_categories'));
    }

    public function addToCart(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size'       => 'required|string', 
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        // 2. Buat ID Unik (Produk ID + Ukuran)
        $cartKey = $product->id . '-' . $request->size;

        // 3. Cek/Update Keranjang
        if(isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                "product_id" => $product->id,
                "name"       => $product->name,
                "quantity"   => 1,
                "price"      => $product->price,
                "image"      => $product->image, // Pastikan kolom ini ada di DB
                "size"       => $request->size
            ];
        }

        // 4. Simpan Session
        session()->put('cart', $cart);
        session()->save();

        // 5. Redirect
        if ($request->input('action') == 'buy_now') {
            return redirect()->route('keranjang');
        }

        return redirect()->back()->with('success', 'Produk berhasil masuk keranjang!');
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            
            session()->flash('success', 'Produk dihapus.');
            return redirect()->back();
        }
    }
}