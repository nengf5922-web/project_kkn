<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Memperbarui data profil (Nama, Email, HP, Alamat).
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // 1. Ambil data dasar (Nama & Email) dari request bawaan
        $data = $request->validated();

        // 2. Validasi tambahan untuk No HP dan Alamat
        $request->validate([
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'], // Validasi Alamat
        ]);

        // 3. Update data User
        $user = $request->user();
        
        $user->fill($data); // Isi Nama & Email
        $user->phone = $request->phone; // Isi No HP
        $user->address = $request->address; // Isi Alamat

        // 4. Cek jika email berubah (reset verifikasi)
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 5. Simpan ke Database
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Menghapus akun user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}