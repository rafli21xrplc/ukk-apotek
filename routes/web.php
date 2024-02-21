<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Generate;
use App\Http\Controllers\Admin\KategoriObatController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Pelanggan\DashboardController as PelangganDashboardController;
use App\Http\Controllers\Pelanggan\TransaksiController as PelangganTransaksiController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\TransaksiController as PetugasTransaksiController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();


Route::middleware('admin')->prefix('/admin')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard.admin');
        Route::get('log/{id}', 'log')->name('log.admin');
    });

    Route::controller(ObatController::class)->group(function () {
        Route::get('obat', 'index')->name('obat.admin');

        Route::post('tambah-obat', 'store')->name('tambah.obat.admin');
        Route::put('update-obat', 'update')->name('update.obat.admin');
        Route::delete('destroy-obat/{id}', 'destroy')->name('destroy.obat.admin');
    });

    Route::controller(KategoriObatController::class)->group(function () {
        Route::get('kategori-obat', 'index')->name('kategori.admin');

        Route::post('tambah-kategori-obat', 'store')->name('tambah.kategori.admin');
        Route::put('update-kategori-obat', 'update')->name('update.kategori.obat.admin');
        Route::delete('destroy-kategori-obat/{id}', 'destroy')->name('destroy.kategori.admin');
    });

    Route::controller(TransaksiController::class)->group(function () {
        Route::get('transaksi', 'index')->name('transaksi.admin');
        Route::get('proses-transaksi', 'proses')->name('proses.transaksi.admin');

        Route::post('tambah-transaksi-obat', 'store')->name('tambah.transaksi.admin');
        Route::post('search-date', 'filterDate')->name('search.date.admin');
        Route::post('approve-obat/{id}', 'approve')->name('approve.obat.admin');
        Route::post('decline-obat/{id}', 'decline')->name('decline.obat.admin');
    });

    Route::controller(Generate::class)->group(function () {
        Route::get('generate', 'generate')->name('generate.admin');
    });
});

Route::middleware('petugas')->prefix('/petugas')->group(function () {
    Route::controller(PetugasDashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('transaksi.dashboard');
        Route::post('tambah-transaksi-obat', 'store')->name('tambah.transaksi.petugas');
        Route::post('search-date', 'filterDate')->name('search.date.petugas');
    });

    Route::controller(Generate::class)->group(function () {
        Route::get('generate', 'generate')->name('generate.petugas');
    });
});

Route::middleware('pelanggan')->prefix('/pelanggan')->group(function () {
    Route::controller(PelangganDashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard.pelanggan');
        Route::post('generate/{id}', 'generate')->name('generate.transaksi.pelanggan');
        Route::post('tambah', 'tambah')->name('tambah.transaksi.pelanggan');
    });

    Route::controller(PelangganTransaksiController::class)->group(function () {
        Route::get('transaksi', 'index')->name('transaksi.pelanggan');
    });
});
