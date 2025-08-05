<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'publisher' => $this->faker->company(),
            'isbn' => $this->faker->isbn13(),
            'year' => $this->faker->year(),
            'stock' => rand(1, 10),
            'cover' => 'https://picsum.photos/300/400?random=' . $this->faker->unique()->numberBetween(1, 1000),
        ];
    }
}
