<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KomikController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (): void {
    Route::apiResource('kategori', KategoriController::class);
    Route::apiResource('komiks', KomikController::class);
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
});
