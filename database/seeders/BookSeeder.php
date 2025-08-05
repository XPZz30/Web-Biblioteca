<?php

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'title' => 'O Senhor dos Anéis',
            'author' => 'J.R.R. Tolkien',
            'publisher' => 'HarperCollins',
            'isbn' => '9780007525546',
            'year' => 1954,
            'stock' => 5
        ]);

        Book::factory()->count(20)->create(); // livros aleatórios (se factory existir)
    }
}
