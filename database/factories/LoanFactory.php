<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Book;

class LoanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? 1,
            'book_id' => Book::inRandomOrder()->first()?->id ?? 1,
            'loan_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'return_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'returned_at' => null,
            'status' => $this->faker->randomElement(['pendente', 'aprovado', 'devolvido']),
        ];
    }
}
