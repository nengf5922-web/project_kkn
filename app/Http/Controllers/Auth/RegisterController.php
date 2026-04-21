<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Tampilkan Form Register
    public function index()
    {
        return view('auth.register'); // Pastikan nama file view Anda benar
    }

    // Proses Simpan Data
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|email|unique:users',
            'phone'     => 'required|numeric',
            'address'   => 'required',
            'password'  => 'required|min:5|confirmed' // Confirmed cek input 'password_confirmation'
        ]);

        // 2. Enkripsi Password
        $validatedData['password'] = Hash::make($validatedData['password']);
        
        // 3. Set Role Default
        $validatedData['role'] = 'user';

        // 4. Simpan ke Database
        User::create($validatedData);

        // 5. Redirect ke Login dengan Pesan Sukses
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}