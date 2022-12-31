<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }
    public function store(Request $request)
    {
        // Form Validation
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            // Bisa juga pake Array, jadi kek gini
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        // Endkripsi Password cara 1
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Endkripsi Password cara 2
        // $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // Cara pertama yang ini buat flash message nya, yang bacaan 'success' itu parameter buat manggil di form yang mau di tuju
        $request->session()->flash('success', 'Registration successful!! Please login');

        // Cara kedua bisa di gabung ama redirect nya kaya gini
        // return redirect('/login');
        return redirect('/login')->with('success', 'Registration successful!! Please login');
    }
}