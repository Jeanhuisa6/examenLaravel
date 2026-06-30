<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\Api\ProductoController as ApiProductoController;
use App\Http\Controllers\Api\CategoriaController as ApiCategoriaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('productos', ProductoController::class);

Route::get('/api/productos', [ApiProductoController::class, 'index']);
Route::post('/api/productos', [ApiProductoController::class, 'store']);

Route::get('/api/categorias', [ApiCategoriaController::class, 'index']);
Route::post('/api/categorias', [ApiCategoriaController::class, 'store']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
