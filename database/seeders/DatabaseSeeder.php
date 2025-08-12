<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\BookSeeder;
use Database\Seeders\VendaSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategorySeeder::class, // Deve vir primeiro
            BookSeeder::class,
            UserSeeder::class,
        ]);
    }
}