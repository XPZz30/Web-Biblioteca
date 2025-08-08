<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;

Route::get('/livros', [BookController::class, 'index'])->name('livros.index');
Route::get('/search', [BookController::class, 'search'])->name('search');
Route::get('/autores', [AuthorController::class, 'index'])->name('autores.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/login', [AuthorController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthorController::class, 'login'])->name('login');