<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Livros específicos com capas do Picsum
        $specificBooks = [
            [
                'title' => 'O Senhor dos Anéis',
                'author' => 'J.R.R. Tolkien',
                'publisher' => 'HarperCollins',
                'isbn' => '9780007525546',
                'year' => 1954,
                'stock' => 5,
                'price' => 89.90,
                'description' => 'A épica trilogia de fantasia que definiu o gênero.',
                'cover' => 'https://picsum.photos/200/300?book=1'
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'publisher' => 'Pearson',
                'isbn' => '9780132350884',
                'year' => 2008,
                'stock' => 8,
                'price' => 120.50,
                'description' => 'Um manual de práticas recomendadas para desenvolvimento de software.',
                'cover' => 'https://picsum.photos/200/300?book=2'
            ],
            [
                'title' => 'Dom Casmurro',
                'author' => 'Machado de Assis',
                'publisher' => 'Editora Garnier',
                'isbn' => '9788533606542',
                'year' => 1899,
                'stock' => 10,
                'price' => 45.90,
                'description' => 'Uma das obras mais importantes da literatura brasileira.',
                'cover' => 'https://picsum.photos/200/300?book=3'
            ]
        ];

        foreach ($specificBooks as $bookData) {
            Book::create($bookData);
        }

        // Gerar livros aleatórios
        Book::factory()
            ->count(17) // Totalizando 20 livros (3 específicos + 17 aleatórios)
            ->create()
            ->each(function ($book) {
                // Atribuir categorias aleatórias
                $book->categories()->attach(
                    \App\Models\Category::inRandomOrder()
                        ->take(rand(1, 3))
                        ->pluck('id')
                );

                // Atribuir capa aleatória do Picsum
                $book->update([
                    'cover' => $this->getPicsumCover()
                ]);
            });
    }

    protected function getPicsumCover()
    {
        // Gera uma URL única para cada livro
        return 'https://picsum.photos/200/300?random=' . rand(1000, 9999);
    }
}