<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\ProdukController;
Route::resource('produk', ProdukController::class)->middleware('auth');

use App\Http\Controllers\KategoriController;
Route::resource('kategori', KategoriController::class)->middleware('auth');

use App\Http\Controllers\TransaksiController;
Route::resource('transaksi', TransaksiController::class)->middleware('auth');

Route::get('laporan', [TransaksiController::class, 'laporan'])->middleware('auth')->name('laporan');

Route::get('transaksi/{transaksi}/struk', [TransaksiController::class, 'struk'])->middleware('auth')->name('transaksi.struk');

require __DIR__.'/auth.php';
