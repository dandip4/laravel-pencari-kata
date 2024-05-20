<?php

use App\Http\Controllers\KataController;
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


Route::controller(KataController::class)->group(function () {
    Route::get('/', 'dashboard')->name('/');

            Route::get('/kategori/view', 'viewKategori')->name('kategori.view');
            Route::post('/kategori/simpan', 'simpanKategori')->name('kategori.simpan');
            Route::get('/kategori/delete/{id}', 'deleteKategori')->name('kategori.delete');

            Route::get('/kelas/view', 'viewKelas')->name('kelas.view');
            Route::post('/kelas/simpan', 'simpanKelas')->name('kelas.simpan');
            Route::get('/kelas/delete/{id}', 'deleteKelas')->name('kelas.delete');
        });
        Route::get('kata/search-results', [KataController::class, 'searchResults'])->name('kata.searchResults');
        Route::get('/search', [KataController::class, 'search'])->name('kata.search');
        Route::get('/kata', [KataController::class, 'index'])->name('kata.index');
        Route::get('/kata/create', [KataController::class, 'create'])->name('kata.create');
        Route::post('/kata', [KataController::class, 'store'])->name('kata.store');
        Route::get('/kata/{kata}', [KataController::class, 'show'])->name('kata.show');
        Route::get('/kata/{kata}/edit', [KataController::class, 'edit'])->name('kata.edit');
        Route::put('/kata/{kata}', [KataController::class, 'update'])->name('kata.update');
        Route::delete('/kata/{kata}', [KataController::class, 'destroy'])->name('kata.destroy');
