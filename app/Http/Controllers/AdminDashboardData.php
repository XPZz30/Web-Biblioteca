<?php
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Venda;
use App\Models\Loan;

$booksCount = Book::count();
$categoriesCount = Category::count();
$usersCount = User::where('role', 'user')->count();
$adminsCount = User::where('role', 'admin')->count();
$loansCount = Loan::count();

return compact('booksCount', 'categoriesCount', 'usersCount', 'adminsCount', 'loansCount');
