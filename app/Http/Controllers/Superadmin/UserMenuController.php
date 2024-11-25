<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserMenuController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('superadmin.userread', compact('users'));
    }

    public function edit($email)
    {
        $user = User::where('email', $email)->first();
        return view('superadmin.useredit', compact('user'));
    }

    public function delete($email)
    {
        User::where('email', $email)->delete();
        return redirect()->route('usermenu.index')->with('success', 'User deleted successfully');
    }
}
