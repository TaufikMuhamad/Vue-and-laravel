<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SiswaController;
use App\Http\Controllers\Api\HobiController;

/*
|----------------------------------------------------------------------
| Rute API
|----------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute API untuk aplikasi Anda.
| Rute-rute ini dimuat oleh RouteServiceProvider dan semua
| akan diberi grup middleware "api". Buatlah sesuatu yang hebat!
|
*/




Route::get('siswa', [SiswaController::class, 'index']);
Route::post('siswa', [SiswaController::class, 'store']);
Route::get('siswa/{id}', [SiswaController::class, 'show']);
Route::put('/siswa/{id}', [SiswaController::class, 'update']);
Route::delete('siswa/{id}', [SiswaController::class, 'destroy']);

// Hobi
Route::get('hobi', [HobiController::class, 'index']);
Route::post('hobi', [HobiController::class, 'store']);
