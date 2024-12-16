<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserMenuController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('Owner.userread', compact('users'));
    }

    public function create()
    {
        return view('Owner.usercreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:3',
            'password' => 'required|min:6|confirmed',
            'status_pekerjaan' => 'required|in:Owner,Kasir',
        ]);

        User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status_pekerjaan' => $request->status_pekerjaan,
        ]);

        return redirect()->route('usermenu.index')->with('success', 'User created successfully');
    }

    public function edit($email)
    {
        $user = User::where('email', $email)->firstOrFail(); // Ambil data user berdasarkan email
        return view('Owner.useredit', compact('user'));
    }

    // Method update
    public function update(Request $request, $email)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $email . ',email',
            'username' => 'required|string|max:255',
            'status_pekerjaan' => 'required|in:Owner,Kasir',
            'password' => 'nullable|string|min:8|confirmed', // Password boleh kosong, tapi harus valid dan terkonfirmasi
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $email)->firstOrFail();

        // Update email, username, dan status_pekerjaan
        $user->email = $request->email;
        $user->username = $request->username;
        $user->status_pekerjaan = $request->status_pekerjaan;

        // Cek apakah ada password baru, jika ada maka hash dan simpan
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan
        $user->save();

        return redirect()->route('usermenu.index')->with('success', 'User updated successfully.');
    }

    public function delete($email)
    {
        User::where('email', $email)->delete();
        return redirect()->route('usermenu.index')->with('success', 'User deleted successfully');
    }
}

