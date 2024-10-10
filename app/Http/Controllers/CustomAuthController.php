<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    // Menampilkan form login
    public function index()
    {
        return view('perpus.login'); // Pastikan ada view login.blade.php di folder views/perpus
    }

    // Method untuk login pengguna
    public function customLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt login menggunakan Auth
        if (Auth::attempt($credentials)) {
            // Redirect ke halaman perpus.show setelah login
            return redirect()->route('perpus.store')->withSuccess('Login successful');
        }

        // Jika gagal login, kembali ke halaman login dengan error
        return redirect()->back()->withErrors('Login failed, please check your credentials and try again.');
    }

    // Menampilkan form registrasi
    public function registration()
    {
        return view('perpus.registration'); // Pastikan ada view registration.blade.php
    }

    // Method untuk custom registrasi
    public function customRegistration(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Membuat user baru
        $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        // Setelah registrasi sukses, login dan redirect ke perpus.show
        Auth::login($user);
        return redirect()->route('perpus.store')->withSuccess('Registration successful');
    }

    // Method untuk logout
    public function logout()
    {
        // Logout pengguna
        Auth::logout();
        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
