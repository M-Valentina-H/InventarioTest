<?php

use App\Http\Controllers\{CategoriaController, DashboardController, ProductoController, ProfileController, SubCategoriaController, UsuarioController};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

//Para cualquier usuario autenticado
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // ... CATEGORIAS
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    // ... SUBCATEGORIAS
    Route::get('/subcategorias', [SubCategoriaController::class, 'index'])->name('subcategorias.index');
    // ... PRODUCTOS
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
});

//Para usuarios con rol de administrador
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    // ... CATEGORIAS
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::patch('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
    // ... SUBCATEGORIAS
    Route::get('/subcategorias/create', [SubCategoriaController::class, 'create'])->name('subcategorias.create');
    Route::post('/subcategorias', [SubCategoriaController::class, 'store'])->name('subcategorias.store');
    Route::get('/subcategorias/{subcategoria}/edit', [SubCategoriaController::class, 'edit'])->name('subcategorias.edit');
    Route::patch('/subcategorias/{subcategoria}', [SubCategoriaController::class, 'update'])->name('subcategorias.update');
    Route::delete('/subcategorias/{subcategoria}', [SubCategoriaController::class, 'destroy'])->name('subcategorias.destroy');
    // ... PRODUCTOS
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::patch('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});

require __DIR__ . '/auth.php';
