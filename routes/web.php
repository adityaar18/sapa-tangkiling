<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RtRwController;
use App\Http\Controllers\LurahController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PenandatanganController;
use App\Http\Controllers\BidangSuratController;
use App\Http\Controllers\NomorSuratController;
use App\Http\Controllers\TemplateSuratController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\SuratController;



Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', fn() => view('dashboard'))->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'role:rt,rw'])->group(function () {
    Route::get('/rtrw/surat', [RtRwController::class, 'index'])->name('surat.rtrw');
    Route::get('/rtrw/buatsurat/create', [RtRwController::class, 'create'])->name('surat.rtrw.create');
    Route::post('/rtrw/buatsurat', [RtRwController::class, 'store'])->name('surat.rtrw.store');
    Route::get('/rtrw/surat/{id}', [RtRwController::class, 'show'])->name('surat.rtrw.show');
});

Route::middleware(['auth', 'role:lurah'])->group(function () {
    Route::get('/lurah/validasi', [LurahController::class, 'indexValidasi'])->name('lurah.validasi');
    Route::post('/lurah/validasi/{id}', [LurahController::class, 'validasiSurat'])->name('lurah.validasiSurat');
    Route::post('/lurah/validasi/tolak/{id}', [LurahController::class, 'tolakSurat'])->name('lurah.tolakSurat');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan');
    Route::get('/jabatan/create', [JabatanController::class, 'create'])->name('jabatan.create');
    Route::post('/jabatan', [JabatanController::class, 'store'])->name('jabatan.store');
    Route::get('/jabatan/{id}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
    Route::delete('/jabatan/{id}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');
    Route::put('/jabatan/{id}', [JabatanController::class, 'update'])->name('jabatan.update');

    Route::get('/penandatangan', [PenandatanganController::class, 'index'])->name('penandatangan');
    Route::get('/penandatangan/create', [PenandatanganController::class, 'create'])->name('penandatangan.create');
    Route::post('/penandatangan', [PenandatanganController::class, 'store'])->name('penandatangan.store');
    Route::get('/penandatangan/{id}/edit', [PenandatanganController::class, 'edit'])->name('penandatangan.edit');
    Route::put('/penandatangan/{id}', [PenandatanganController::class, 'update'])->name('penandatangan.update');
    Route::delete('/penandatangan/{id}', [PenandatanganController::class, 'destroy'])->name('penandatangan.destroy');

    Route::get('/bidangsurat', [BidangSuratController::class, 'index'])->name('bidangsurat');
    Route::get('/bidangsurat/create', [BidangSuratController::class, 'create'])->name('bidangsurat.create');
    Route::post('/bidangsurat', [BidangSuratController::class, 'store'])->name('bidangsurat.store');
    Route::get('/bidangsurat/{id}/edit', [BidangSuratController::class, 'edit'])->name('bidangsurat.edit');
    Route::put('/bidangsurat/{id}', [BidangSuratController::class, 'update'])->name('bidangsurat.update');
    Route::delete('/bidangsurat/{id}', [BidangSuratController::class, 'destroy'])->name('bidangsurat.destroy');

    Route::get('/nomorsurat', [NomorSuratController::class, 'index'])->name('nomorsurat');
    Route::get('/nomorsurat/create', [NomorSuratController::class, 'create'])->name('nomorsurat.create');
    Route::post('/nomorsurat', [NomorSuratController::class, 'store'])->name('nomorsurat.store');
    Route::get('/nomorsurat/{id}/edit', [NomorSuratController::class, 'edit'])->name('nomorsurat.edit');
    Route::put('/nomorsurat/{id}', [NomorSuratController::class, 'update'])->name('nomorsurat.update');
    Route::delete('/nomorsurat/{id}', [NomorSuratController::class, 'destroy'])->name('nomorsurat.destroy');

    Route::get('/templatesurat', [TemplateSuratController::class, 'index'])->name('template_surat');
    Route::get('/templatesurat/create', [TemplateSuratController::class, 'create'])->name('template_surat.create');
    Route::post('/templatesurat', [TemplateSuratController::class, 'store'])->name('template_surat.store');
    Route::get('/templatesurat/{id}/edit', [TemplateSuratController::class, 'edit'])->name('template_surat.edit');
    Route::put('/templatesurat/{id}', [TemplateSuratController::class, 'update'])->name('template_surat.update');
    Route::delete('/templatesurat/{id}', [TemplateSuratController::class, 'destroy'])->name('template_surat.destroy');

    Route::get('/jenissurat', [JenisSuratController::class, 'index'])->name('jenis_surat');
    Route::get('/jenissurat/create', [JenisSuratController::class, 'create'])->name('jenis_surat.create');
    Route::post('/jenissurat', [JenisSuratController::class, 'store'])->name('jenis_surat.store');
    Route::get('/jenissurat/{id}/edit', [JenisSuratController::class, 'edit'])->name('jenis_surat.edit');
    Route::put('/jenissurat/{id}', [JenisSuratController::class, 'update'])->name('jenis_surat.update');
    Route::delete('/jenissurat/{id}', [JenisSuratController::class, 'destroy'])->name('jenis_surat.destroy');
});

Route::middleware(['auth', 'role:admin,lurah'])->group(function () {
    Route::get('/buatsurat', [SuratController::class, 'index'])->name('surat');
    Route::get('/buatsurat/create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/buatsurat', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/buatsurat/{id}/edit', [SuratController::class, 'edit'])->name('surat.edit');
    Route::put('/buatsurat/{id}', [SuratController::class, 'update'])->name('surat.update');
    Route::delete('/buatsurat/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');
    Route::get('/buatsurat/{id}', [SuratController::class, 'show'])->name('surat.show');
    Route::get('/buatsurat/{id}/generate', [SuratController::class, 'generateSurat'])->name('surat.generate');
});
