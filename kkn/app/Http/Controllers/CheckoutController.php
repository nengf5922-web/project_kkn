<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category; // 1. Tambahkan ini agar Navbar tidak error

// 2. Hapus 'extends Controller'
class CheckoutController
{
    // Fungsi Menampilkan Halaman Checkout
    public function index()
    {
        $cart = session()->get('cart', []);
        
        // Redirect jika keranjang kosong
        if(count($cart) == 0) {
            return redirect()->route('keranjang')->with('error', 'Keranjang Anda kosong.');
        }

        // Hitung Subtotal
        $subtotal = 0;
        foreach($cart as $id => $details) {
            $subtotal += $details['price'] * $details['quantity'];
        }

        $ongkir = 20000;
        $grand_total = $subtotal + $ongkir;
        $user = auth()->user();

        // 3. Ambil Kategori untuk Navbar (PENTING)
        $global_categories = Category::all();

        // Kirim semua variabel ke view
        return view('checkout.index', compact('cart', 'subtotal', 'ongkir', 'grand_total', 'user', 'global_categories'));
    }

    // Fungsi Memproses Pesanan (Simpan ke Database)
    public function process(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'payment_method' => 'required'
        ]);

        // 2. Ambil Data Keranjang
        $cart = session()->get('cart', []);
        if(count($cart) == 0) {
            return redirect()->route('home')->with('error', 'Keranjang kosong!');
        }

        // 3. Hitung Total
        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $ongkir = 20000;
        $total_price = $subtotal + $ongkir;

        // 4. SIMPAN KE DATABASE (Tabel Orders)
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'total_price' => $total_price
        ]);

        // 5. SIMPAN ITEM (Tabel OrderItems)
        foreach($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $details['product_id'], 
                'product_name' => $details['name'],
                'price' => $details['price'],
                'quantity' => $details['quantity']
            ]);
        }

        // 6. Hapus Keranjang & Redirect
        session()->forget('cart');
        
        return redirect()->route('home')->with('transaction_success', 'Pesanan #' . $order->id . ' berhasil dibuat!');
    }
}