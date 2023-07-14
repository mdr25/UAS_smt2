<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Toko;
use App\Http\Controllers\History;
use App\Http\Controllers\Profile;
use Illuminate\Support\Facades\Route;
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

Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });

// Halaman Home untuk semua pengguna
Route::redirect('/', '/home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('pesan/{id}', [Toko::class, 'index']);
    Route::post('pesan/{id}', [Toko::class, 'pesan']);

    // Check Out
    Route::get('checkout', [Toko::class, 'checkout']);
    Route::delete('checkout/{id}', [Toko::class, 'delete']);
    Route::get('checkout-confirmation', [Toko::class, 'confirm']);

    // Orders
    Route::get('history', [History::class, 'index']);
    Route::get('invoice/{id}', [History::class, 'detail']);

    // Profile
    Route::get('profile', [Profile::class, 'index']);
    Route::post('profile', [Profile::class, 'update']);
});

// Admin Dashboard
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [Toko::class, 'admin']);
    // Product Category
    Route::get('/admin/kategori', [Toko::class, 'kategoriAdmin'])->name('produk.kategori');

    Route::get('/admin/addkategori', [Toko::class, 'newKategori']);
    Route::post('/admin/addkategori', [Toko::class, 'addKategori'])->name('kategori.add');

    Route::get('admin/editkategori/{id}', [Toko::class, 'editKategori'])->name('kategori.edit');
    Route::post('/admin/updatekategori/{id}', [Toko::class, 'updateKategori'])->name('kategori.update');

    Route::delete('/admin/deletekategori/{id}', [Toko::class, 'destroyKategori'])->name('kategori.destroy');

    // Product Section
    Route::get('/admin/produk', [Toko::class, 'produkAdmin']);

    Route::get('/admin/addproduk', [Toko::class, 'newProduk']);
    Route::post('/admin/addproduk', [Toko::class, 'addProduk'])->name('produk.add')->middleware('web');
    // Route::post('/admin/addproduk', [Toko::class, 'addProduk'])->name('produk.add');

    Route::get('admin/editproduk/{id}', [Toko::class, 'editProduk'])->name('produk.edit');
    Route::put('/admin/updateProduk/{id}', [Toko::class, 'updateProduk'])->name('produk.update');

    Route::delete('/admin/deleteProduk/{id}', [Toko::class, 'destroy'])->name('produk.destroy');
});
