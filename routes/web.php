<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin']);
// Halaman register
// Halaman Register
Route::get('/register', [AuthController::class, 'register'])->name('register');

// Proses Register
Route::post('/register', [AuthController::class, 'handleRegister'])->name('register.process');

Route::middleware(['auth', 'role:Superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [DashboardController::class, 'superadmin']);
});

Route::middleware(['auth', 'role:Kasir'])->group(function () {
    Route::get('/kasir/dashboard', [DashboardController::class, 'kasir']);
});

// Route Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Redirect ke halaman login setelah logout
})->name('logout');


use App\Http\Controllers\Superadmin\UserMenuController;

Route::middleware(['auth', 'role:Superadmin'])->group(function () {
    Route::get('/superadmin/userread', [UserMenuController::class, 'index'])->name('usermenu.index');
    Route::get('/superadmin/useredit/{email}', [UserMenuController::class, 'edit'])->name('usermenu.edit');
    Route::delete('/superadmin/userdelete/{email}', [UserMenuController::class, 'delete'])->name('usermenu.delete');
});

use App\Http\Controllers\Superadmin\ProductMenuController;
Route::middleware(['auth', 'role:Superadmin'])->group(function () {
    Route::get('/superadmin/productread', [ProductMenuController::class, 'index'])->name('productmenu.index');
    Route::get('/superadmin/productcreate', [ProductMenuController::class, 'create'])->name('productmenu.create');
    Route::post('/superadmin/productstore', [ProductMenuController::class, 'store'])->name('productmenu.store');
    Route::get('/superadmin/productedit/{id}', [ProductMenuController::class, 'edit'])->name('productmenu.edit');
    Route::put('/superadmin/productupdate/{id}', [ProductMenuController::class, 'update'])->name('productmenu.update');
    Route::delete('/superadmin/productdelete/{id}', [ProductMenuController::class, 'destroy'])->name('productmenu.destroy');
});
