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

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status_pekerjaan === 'Owner') {
                return redirect('/Owner/dashboard');
            } elseif ($user->status_pekerjaan === 'Kasir') {
                return redirect('/kasir/Transaksi');
            }
        }

        return back()->with('error', 'Invalid login credentials.');
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
