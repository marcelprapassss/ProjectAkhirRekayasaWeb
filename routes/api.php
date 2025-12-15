<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\PelangganController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// rute public untuk login dan daftar dapat token
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    //crud produk
    Route::post('/produk/create', [ProdukController::class, 'store']);
    Route::get('/produk/read', [ProdukController::class, 'index']);           
    Route::get('/produk/read/{id}', [ProdukController::class, 'show']);             
    Route::put('/produk/update/{id}', [ProdukController::class, 'update']);   
    Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy']); 

    //crud kategori
    Route::post('/kategori/create', [KategoriController::class, 'store']);
    Route::get('/kategori/read', [KategoriController::class, 'index']);
    Route::get('/kategori/read/{id}', [KategoriController::class, 'show']);
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update']);
    Route::delete('/kategori/delete/{id}', [KategoriController::class, 'destroy']);

    //crud pelanggan
    Route::post('/pelanggan/create', [PelangganController::class, 'store']);
    Route::get('/pelanggan/read', [PelangganController::class, 'index']);
    Route::get('/pelanggan/read/{id}', [PelangganController::class, 'show']);
    Route::put('/pelanggan/update/{id}', [PelangganController::class, 'update']);
    Route::delete('/pelanggan/delete/{id}', [PelangganController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);

});