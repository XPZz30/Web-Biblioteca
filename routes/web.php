<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BookController,
    AuthorController,
    CategoryController,
    VendaController,
    AuthController
};

// Rotas públicas
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/', [AuthController::class, 'login'])
    ->name('login')
    ->middleware('throttle:5,1');

// Rotas autenticadas
Route::middleware('auth')->group(function () {
    // Empréstimos
    Route::get('/loans', [App\Http\Controllers\LoanController::class, 'index'])->name('loans.index'); // admin
    Route::post('/loans', [App\Http\Controllers\LoanController::class, 'store'])->name('loans.store'); // usuário
    Route::post('/loans/{id}/finish', [App\Http\Controllers\LoanController::class, 'finish'])->name('loans.finish'); // devolução
    // Usuários
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    // Livros
    Route::prefix('livros')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('livros.index');
        Route::get('/search', [BookController::class, 'search'])->name('search'); // Nome mantido como 'search'
        Route::get('/livros/{id}', [BookController::class, 'show'])->name('livros.show');
        Route::post('/', [BookController::class, 'store'])->name('livros.store');
        Route::get('/{id}/edit', [BookController::class, 'edit'])->name('livros.edit');
        Route::put('/{id}', [BookController::class, 'update'])->name('livros.update');
        Route::delete('/{id}', [BookController::class, 'destroy'])->name('livros.destroy');
    });

    // Autores
    Route::get('/autores', [AuthorController::class, 'index'])->name('autores.index');

    // Categorias
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Vendas
    Route::post('/vendas', [VendaController::class, 'store'])
        ->name('vendas.store')
        ->middleware('verified');


    // Dashboard admin
    Route::get('/dashboard', [App\Http\Controllers\AuthController::class, 'dashboardAdmin'])->name('admin.dashboard');
    Route::get('/livros', [BookController::class, 'index'])->name('livros.index');
});
