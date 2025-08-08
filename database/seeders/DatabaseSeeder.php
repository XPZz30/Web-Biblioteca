<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(5)->create();
        Book::factory(5)->create();
        Loan::factory(5)->create();
        Category::factory(5)->create();
    }
}
