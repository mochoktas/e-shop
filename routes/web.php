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

use App\Http\Controllers\MasterMejaController;
Route::get('/master/meja', [MasterMejaController::class, 'index'])->name('meja.index');
Route::get('/master/meja/show/{id}', [MasterMejaController::class, 'show'])->name('meja.show');
Route::post('/master/meja/store', [MasterMejaController::class, 'store'])->name('meja.store');  
Route::post('/master/meja/update', [MasterMejaController::class, 'update'])->name('meja.update');
Route::delete('/master/meja/delete/{id}', [MasterMejaController::class, 'destroy'])->name('meja.delete');
Route::get('/master/meja/edit/{id}', [MasterMejaController::class, 'edit'])->name('meja.edit');
Route::get('/master/meja/generate-pdf/{id}', [MasterMejaController::class, 'generatePDF'])->name('meja.generatePDF');
// Route::get('/get-meja', [MasterMejaController::class, 'getMeja'])->name('get.meja');

use App\Http\Controllers\MasterBarangController;
Route::get('/master/barang', [MasterBarangController::class, 'index'])->name('barang.index');
Route::get('/master/barang/show/{id}', [MasterBarangController::class, 'show'])->name('barang.show');
Route::post('/master/barang/store', [MasterBarangController::class, 'store'])->name('barang.store');  
Route::post('/master/barang/update', [MasterBarangController::class, 'update'])->name('barang.update');
Route::delete('/master/barang/delete/{id}', [MasterBarangController::class, 'destroy'])->name('barang.delete');
Route::get('/master/barang/edit/{id}', [MasterBarangController::class, 'edit'])->name('barang.edit');
Route::get('/master/barang/edit-photo/{id}', [MasterBarangController::class, 'editPhoto'])->name('barang.editPhoto');
Route::post('/master/barang/update-photo', [MasterBarangController::class, 'updatePhoto'])->name('barang.updatePhoto');
Route::post('/master/barang/delete-photo', [MasterBarangController::class, 'deletePhoto'])->name('barang.deletePhoto');

// Route::get('/get-barang', [MasterBarangController::class, 'getBarang'])->name('get.barang');