<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomikController;
use Illuminate\Support\Facades\Route;

Route::apiResource('kategori', KategoriController::class);
Route::apiResource('komiks', KomikController::class);
Route::apiResource('anggota', AnggotaController::class);
