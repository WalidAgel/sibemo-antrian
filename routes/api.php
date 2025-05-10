<?php

use App\Http\Controllers\Api\AntrianController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\Api\KendaraanController;
use App\Http\Controllers\Api\PelangganController;
use App\Models\pelanggan;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/login2', [AuthenticationController::class, 'login2']);
Route::get('/saya', [AuthenticationController::class, 'me'])->middleware('auth:sanctum');

Route::prefix('pelanggan')->group(function () {
    Route::post('/set', [PelangganController::class, 'setData']);
    Route::get('/get', [PelangganController::class, 'getData']);
    Route::put('/update/{id}', [PelangganController::class, 'updateData']);
    Route::delete('/delete/{id}', [PelangganController::class, 'deleteData']);
});

Route::prefix('antrian')->group(function () {
    Route::post('/set', [AntrianController::class, 'setData']);
    Route::get('/get', [AntrianController::class, 'getData']);
    Route::put('/update/{id}', [AntrianController::class, 'updateData']);
    Route::delete('/delete/{id}', [AntrianController::class, 'deleteData']);
});

Route::prefix('kendaraan')->group(function () {
    Route::get('/', [KendaraanController::class, 'index']);
    Route::post('/', [KendaraanController::class, 'store']);
    Route::get('/{id}', [KendaraanController::class, 'show']);
    Route::put('/{id}', [KendaraanController::class, 'update']);
    Route::delete('/{id}', [KendaraanController::class, 'destroy']);
});
