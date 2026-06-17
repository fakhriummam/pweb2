<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function processLogin(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format penulisan email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.'
        ]);

        if (Auth::attempt($credentials)) {
            // Regenerasi session ID untuk mencegah celah keamanan Session Fixation
            $request->session()->regenerate();

            // Melemparkan user langsung ke halaman utama surat izin santri kamu
            return redirect()->intended('/dashboard/surat')->with('sukses', 'Selamat Datang Kembali di Sistem Informasi Santri!');
        }

        // Jika gagal login
        return back()->withErrors([
            'login_error' => 'Kombinasi alamat email atau kata sandi Anda salah.',
        ])->onlyInput('email');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function storeRegister(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed' // Input konfirmasi di blade wajib bernama: password_confirmation
        ], [
            'email.unique' => 'Alamat email ini sudah terdaftar di sistem.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.'
        ]);

        // Enkripsi password menggunakan Hash::make (Bcrypt) sebelum disimpan
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'santri' // Default otomatis terdaftar sebagai santri biasa
        ]);

        return redirect()->route('login')->with('sukses', 'Pendaftaran akun berhasil! Silakan masuk.');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Mengganti token CSRF token baru

        return redirect()->route('login')->with('sukses', 'Anda telah berhasil keluar dari sistem.');
    }
}
