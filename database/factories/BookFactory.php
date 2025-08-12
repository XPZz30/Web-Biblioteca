<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name,
            'publisher' => $this->faker->company,
            'isbn' => $this->faker->isbn13,
            'year' => $this->faker->year,
            'stock' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->randomFloat(2, 10, 200),
            'description' => $this->faker->paragraphs(3, true),
            'cover' => $this->getRandomCoverImage(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    protected function getRandomCoverImage()
    {
        $services = [
            'https://picsum.photos/200/300?random='.rand(1, 1000),
            'https://source.unsplash.com/random/200x300/?book,cover',
            'https://fakeimg.pl/200x300/'.substr(md5(rand()), 0, 6).'/'.substr(md5(rand()), 0, 6).'/?text=Book+Cover'
        ];

        return $this->faker->randomElement($services);
    }
}