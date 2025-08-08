<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Book;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            // Autores (mantendo como array de strings)
            $authors = Book::distinct()->pluck('author')->toArray();

            // Categorias (agora trazendo objetos completos)
            $categories = Category::orderBy('name')->get();

            $view->with([
                'authors' => $authors,
                'categories' => $categories
            ]);
        });
    }
}
