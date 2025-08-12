<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'isbn',
        'year',
        'stock',
        'cover',
        'price',
        'description'
    ];

    // Relacionamento muitos-para-muitos com Categories
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }
    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
