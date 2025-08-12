<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\AuthController;

// Rota de login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Proteger rotas que requerem login
Route::middleware('auth')->group(function () {
    Route::get('/livros', [BookController::class, 'index'])->name('livros.index');
    Route::get('/search', [BookController::class, 'search'])->name('search');
    Route::get('/autores', [AuthorController::class, 'index'])->name('autores.index');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/livros/{id}', [BookController::class, 'show'])->name('livros.show');
    Route::post('/vendas', [VendaController::class, 'store'])->name('vendas.store');
});
