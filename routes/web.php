<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BookController,
    AuthorController,
    CategoryController,
    VendaController,
    AuthController,
    AdminController
};

// Rotas públicas
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/', [AuthController::class, 'login'])
    ->name('login')
    ->middleware('throttle:5,1');

// Rotas autenticadas
Route::middleware('auth')->group(function () {
    // Livros
    Route::prefix('livros')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('livros.index');
        Route::get('/search', [BookController::class, 'search'])->name('search'); // Nome mantido como 'search'
        Route::get('/livros/{id}', [BookController::class, 'show'])->name('livros.show');
    });

    // Autores
    Route::get('/autores', [AuthorController::class, 'index'])->name('autores.index');

    // Categorias
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    // Vendas
    Route::post('/vendas', [VendaController::class, 'store'])
        ->name('vendas.store')
        ->middleware('verified');



});
