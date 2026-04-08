<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan Halaman Login
    public function index()
    {
        return view('auth.login');
    }

    // Proses Verifikasi Login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (auth()->user()->role == 'admin') {
                return redirect()->intended('halaman_utama')->with('notice', 'Selamat Datang Atasan!');
            } else {
                return redirect()->intended('halaman_utama')->with('notice', 'Selamat Datang Pegawai!');
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('notice', 'Anda telah berhasil keluar.');
    }
}