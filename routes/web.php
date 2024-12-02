<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DistribusiController;




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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('dashboard')->middleware(['auth'])->group(function() {
    Route::get('/', function() {
        return view('dashboard.index');
    })->name('dashboard');

    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::post('/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('update', [UserController::class, 'update'])->name('user.update');
        Route::post('/delete', [UserController::class, 'delete'])->name('user.delete');
    });

    Route::prefix('products')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::post('/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/update', [ProductController::class, 'update'])->name('product.update');
        Route::post('delete', [ProductController::class, 'destroy'])->name('product.delete');
    });

    Route::prefix('distributors')->group(function() {
        Route::get('/', [DistribusiController::class, 'index'])->name('distributor.index');
    });

    Route::prefix('kategoris')->group(function() {
        Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
        Route::post('/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::post('/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/Update', [KategoriController::class, 'update'])->name('kategori.update');
        Route::post('delete', [KategoriController::class, 'delete'])->name('kategori.delete');
    });

    Route::get('pemesanan', [PelangganController::class, 'index'])->name('pesan.index');
    Route::get('daftar_barang/{id}', [PelangganController::class, 'daftarBarang'])->name('daftar_barang');
});

require __DIR__.'/auth.php';
