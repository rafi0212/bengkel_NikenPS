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

use App\Http\Controllers\POSController;

Route::get('/coba', [POSController::class, 'index'])->name('pos.index');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'handleRegister'])->name('register.process');

Route::middleware(['auth', 'role:Owner'])->group(function () {
    Route::get('/Owner/dashboard', [DashboardController::class, 'Owner']);
});

Route::middleware(['auth', 'role:Kasir'])->group(function () {
    Route::get('/kasir/Transaksi', [DashboardController::class, 'kasir']);
});

// Route Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); 
})->name('logout');


use App\Http\Controllers\Owner\UserMenuController;

Route::middleware(['auth', 'role:Owner'])->group(function () {
    Route::get('/Owner/userread', [UserMenuController::class, 'index'])->name('usermenu.index');
    Route::get('/Owner/usercreate', [UserMenuController::class, 'create'])->name('usermenu.create');
    Route::post('/Owner/userstore', [UserMenuController::class, 'store'])->name('usermenu.store');
    Route::get('/Owner/useredit/{email}', [UserMenuController::class, 'edit'])->name('usermenu.edit');
    Route::put('/Owner/userupdate/{email}', [UserMenuController::class, 'update'])->name('usermenu.update'); // Route untuk update
    Route::delete('/Owner/userdelete/{email}', [UserMenuController::class, 'delete'])->name('usermenu.delete');
});


use App\Http\Controllers\Owner\ProductMenuController;

Route::middleware(['auth', 'role:Owner'])->group(function () {
    Route::get('/Owner/productread', [ProductMenuController::class, 'index'])->name('productmenu.index');
    Route::get('/Owner/productcreate', [ProductMenuController::class, 'create'])->name('productmenu.create');
    Route::post('/Owner/productstore', [ProductMenuController::class, 'store'])->name('productmenu.store');
    Route::get('/Owner/productedit/{no_produk}', [ProductMenuController::class, 'edit'])->name('productmenu.edit');
    Route::put('/Owner/productedit/{no_produk}', [ProductMenuController::class, 'update'])->name('productmenu.update');
    Route::delete('/Owner/productdelete/{id}', [ProductMenuController::class, 'destroy'])->name('productmenu.destroy');
});

use App\Http\Controllers\Owner\KategoriController;

Route::middleware(['auth', 'role:Owner'])->group(function () {
    Route::get('/Owner/kategoriread', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/Owner/kategoricreate', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/Owner/kategoristore', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/Owner/kategoriedit/{kode_kategori}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/Owner/kategoriupdate/{kode_kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/Owner/kategoridelete/{kode_kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});


use App\Http\Controllers\Owner\TransaksiController;

Route::middleware(['auth', 'role:Owner'])->group(function () {
    Route::get('/Owner/transaksiread', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/Owner/transaksi/export-excel', [TransaksiController::class, 'exportExcel'])->name('transaksi.export.excel');
    Route::get('/Owner/transaksi/export-pdf', [TransaksiController::class, 'exportPDF'])->name('transaksi.export.pdf');
    
});



use App\Http\Controllers\Kasir\KasirTransaksiController;

Route::middleware(['auth', 'role:Kasir'])->group(function () {
    Route::get('/Kasir/transaksiread', [KasirTransaksiController::class, 'index'])->name('kasir.transaksi.index');
    Route::get('/Kasir/transaksi/create', [KasirTransaksiController::class, 'create'])->name('kasir.transaksi.create');
    Route::post('/Kasir/transaksi', [KasirTransaksiController::class, 'store'])->name('kasir.transaksi.store');
    Route::get('/Kasir/transaksi/edit/{id_transaksi}', [KasirTransaksiController::class, 'edit'])->name('kasir.transaksi.edit');
    Route::put('/Kasir/transaksi/edit/{id_transaksi}', [KasirTransaksiController::class, 'update'])->name('kasir.transaksi.update');
    Route::delete('/Kasir/transaksi/{id_transaksi}', [KasirTransaksiController::class, 'destroy'])->name('kasir.transaksi.destroy');
});

// routes/web.php

use App\Http\Controllers\Kasir\DetailTransaksiController;

Route::middleware(['auth', 'role:Kasir'])->group(function () {
    Route::get('/Kasir/transaksi/detail/{id_transaksi}', [DetailTransaksiController::class, 'show'])->name('kasir.detail.show');
    Route::get('/Kasir/transaksi/tambah/{id_transaksi}', [DetailTransaksiController::class, 'tambah'])->name('kasir.detail.tambah');
    Route::get('/Kasir/transaksi/edit/{id_transaksi}/{no_produk}', [DetailTransaksiController::class, 'edit'])->name('kasir.detail.edit');
    Route::post('/Kasir/transaksi/tambah/{id_transaksi}', [DetailTransaksiController::class, 'tambahDetailProduk'])->name('kasir.detail.tambahDetailProduk');
    Route::put('/Kasir/transaksi/update/{id_transaksi}/{no_produk}', [DetailTransaksiController::class, 'update'])->name('kasir.detail.update');
    Route::delete('/Kasir/transaksi/hapus/{id_transaksi}/{no_produk}', [DetailTransaksiController::class, 'destroy'])->name('kasir.detail.destroy');
});