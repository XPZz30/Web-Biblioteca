<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenLibraryService
{
    /**
     * Obtém dados de um livro da Open Library API usando ISBN
     *
     * @param string $isbn Número ISBN do livro
     * @return array|null Retorna os dados do livro ou null se não encontrado
     */
    public function getBookByJson($isbn)
    {
        try {
            $cleanIsbn = preg_replace('/[^0-9]/', '', $isbn);
            $response = Http::get("https://openlibrary.org/api/books", [
                'bibkeys' => "ISBN:{$cleanIsbn}",
                'format' => 'json',
                'jscmd' => 'data'
            ]);

            $data = $response->json();
            $bookData = $data["ISBN:{$cleanIsbn}"] ?? null;

            return $bookData;
        } catch (\Exception $e) {
            Log::error("OpenLibrary Error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Extrai o ano de publicação de uma string de data
     *
     * @param string|null $dateString Data no formato variado
     * @return string|null Ano extraído ou null
     */
    private function extractYear($dateString)
    {
        if (!$dateString) {
            return null;
        }

        // Tenta extrair 4 dígitos consecutivos (o ano)
        if (preg_match('/\d{4}/', $dateString, $matches)) {
            return $matches[0];
        }

        return null;
    }
}
