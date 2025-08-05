<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/livros', [BookController::class, 'index'])->name('livros.index');
