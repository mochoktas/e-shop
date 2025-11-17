<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home1');
});

use App\Http\Controllers\MasterJenisBarangController;
Route::get('/master/jenis-barang', [MasterJenisBarangController::class, 'index'])->name('jenisBarang.index');
Route::get('/master/jenis-barang/show/{id}', [MasterJenisBarangController::class, 'show'])->name('jenisBarang.show');
Route::post('/master/jenis-barang/store', [MasterJenisBarangController::class, 'store'])->name('jenisBarang.store');
Route::post('/master/jenis-barang/update', [MasterJenisBarangController::class, 'update'])->name('jenisBarang.update');
Route::delete('/master/jenis-barang/delete/{id}', [MasterJenisBarangController::class, 'destroy'])->name('jenisBarang.delete');
Route::get('/master/jenis-barang/edit/{id}', [MasterJenisBarangController::class, 'edit'])->name('jenisBarang.edit');
// Route::get('/get-jenis-barang', [MasterJenisBarangController::class, 'getJenisBarang'])->name('get.jenisBarang');
