<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthController;

// Rutas de autenticación
Route::middleware('guest')->group(function () {
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Ruta de login (POST) fuera del grupo guest
Route::post('/login', [AuthController::class, 'login']);

// Ruta de cierre de sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Página principal
Route::get('/', [ProductoController::class, 'index'])->name('home');

// Rutas protegidas para comerciantes
Route::middleware(['auth', 'comerciante'])->group(function () {
    Route::get('/dashboard', [ProductoController::class, 'dashboard'])->name('dashboard');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});

// Ruta para mostrar productos por categoría
Route::get('/categoria/{id}', [ProductoController::class, 'porCategoria'])->name('categoria.productos');

// Perfil de usuario (solo autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [AuthController::class, 'perfil'])->name('perfil');
    Route::post('/perfil', [AuthController::class, 'actualizarPerfil'])->name('perfil.actualizar');
});

