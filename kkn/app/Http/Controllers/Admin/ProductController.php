<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Wajib ada untuk hapus file
use App\Models\Product;  
use App\Models\Category; 

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk
     */
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Menampilkan form tambah produk
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru (FIXED)
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'sizes' => 'required|string', 
            'image' => 'required|image|file|max:2048', // Wajib ada gambar saat create
            'description' => 'required'
        ]);

        // 2. Logic Upload Gambar (Ini yang sebelumnya hilang)
        $imageName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // Buat nama unik: waktu_namafileasli
            $imageName = time() . '_' . $file->getClientOriginalName();
            // Pindahkan ke folder public/assets/products
            $file->move(public_path('assets/products'), $imageName);
        }

        // 3. Simpan ke Database
        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'sizes' => $request->sizes,
            'description' => $request->description,
            'image' => $imageName // <--- Gunakan variabel $imageName yang sudah dibuat di atas
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit produk
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update produk (FIXED: Efisiensi kode)
     */
    public function update(Request $request, Product $product)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:0',
            'sizes' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // 2. Siapkan data dasar
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'sizes' => $request->sizes,
            'description' => $request->description,
        ];

        // 3. Cek apakah ada gambar baru yang diupload
        if ($request->hasFile('image')) {
            
            // Hapus gambar lama jika ada
            if ($product->image && File::exists(public_path('assets/products/' . $product->image))) {
                File::delete(public_path('assets/products/' . $product->image));
            }
            
            // Upload gambar baru
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/products'), $imageName);
            
            // Masukkan nama gambar baru ke array data
            $data['image'] = $imageName;
        }

        // 4. Update Database (Sekali jalan saja biar rapi)
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk
     */
    public function destroy(Product $product)
    {
        // Hapus gambar fisik di folder assets
        if ($product->image && File::exists(public_path('assets/products/' . $product->image))) {
            File::delete(public_path('assets/products/' . $product->image));
        }

        // Hapus data di database
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}