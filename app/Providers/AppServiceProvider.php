<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Book;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('layouts.app', function ($view) {
            // Busca todos os autores distintos da coluna 'author' da tabela books
            $authors = Book::distinct()->pluck('author')->toArray();
            $view->with('authors', $authors);
        });
    }
}