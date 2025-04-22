<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Rutas públicas
Route::get('/', function () {
    return view('index');
})->name('home');
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return response()->json(['success' => true, 'message' => 'Sesión cerrada']);

})->name('logout');


// Autenticación
Route::post('/registro', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');


// Rutas de productos
Route::get('/productos', [ProductoController::class, 'index']);
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::get('/producto/{id}', [ProductoController::class, 'show']);
Route::get('/productos/categoria/{id}', [ProductoController::class, 'porCategoria']);

// Dashboard protegido
Route::get('/dashboard', function () {
    return 'Bienvenido al dashboard';
})->middleware(['auth', 'verified']);