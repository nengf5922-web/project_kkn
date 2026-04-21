<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category; // <-- Tambahkan ini di atas
use Illuminate\Http\Request; // <-- Tambahkan ini di atas
use Illuminate\Support\Str;   // <-- Tambahkan ini untuk membuat slug

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $categories = Category::all();
    return view('admin.categories.index', ['categories' => $categories]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('admin.categories.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // 1. Validasi input
    $request->validate([
        'name' => 'required|string|max:255|unique:categories',
    ]);

    // 2. Buat dan simpan data
    Category::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name, '-') // Otomatis membuat slug, cth: "Wedding Heels" -> "wedding-heels"
    ]);

    // 3. Kembali ke halaman index dengan pesan sukses
    return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
{
    return view('admin.categories.edit', ['category' => $category]);
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
{
    // 1. Validasi (perhatikan aturan unique)
    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
    ]);

    // 2. Update data
    $category->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name, '-')
    ]);

    // 3. Redirect
    return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
     /**
 * Remove the specified resource from storage.
 */
public function destroy(Category $category)
{
    $category->delete();

    return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
}
    }
