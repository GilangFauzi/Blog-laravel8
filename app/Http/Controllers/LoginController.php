<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login/index', [
            'title' => 'login',
            'active' => 'login'
        ]);
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        // jika authentication benar, maka redirect ke dashboard
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        // jika email atau pass salah malah akan membuat flash data, dan flash ini akan di kirim di index login
        return back()->with('loginError', 'Login Failed!');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        // ini agar tidak bisa dipake
        $request->session()->invalidate();
        // ini perintah buat bikin baru biar ga bisa dibajak
        $request->session()->regenerateToken();
        // balikin mau ke halaman yang dituju
        return redirect('/login');
    }
}