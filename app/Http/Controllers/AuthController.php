<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function handleLogin(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Attempt to log the user in
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if ($user->status_pekerjaan === 'Owner') {
            return redirect('dashboard');
        } elseif ($user->status_pekerjaan === 'Kasir') {
            return redirect('/kasir/transaksi_read');
        }
    }

    // If login fails, redirect back with a custom error message in Indonesian
    return back()->with('error', 'Email atau password yang Anda masukkan salah. Silakan coba lagi.');
}



    public function handleRegister(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status_pekerjaan' => 'Kasir', // Nilai default
        ]);

        return redirect('/login')->with('success', 'Registration successful. Please login.');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
