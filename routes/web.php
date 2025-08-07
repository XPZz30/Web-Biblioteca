<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthController;

Route::get('/livros', [BookController::class, 'index'])->name('livros.index');
Route::get('/search', [BookController::class, 'search'])->name('search');
Route::get('/autores', [AuthorController::class, 'index'])->name('autores.index');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');