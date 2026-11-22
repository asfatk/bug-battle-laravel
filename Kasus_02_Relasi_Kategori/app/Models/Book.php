<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Kolom yang boleh diisi ketika data buku dibuat melalui Book::create().
    protected $fillable = ['title', 'author', 'category_id'];

    public function category()
    {
        // Satu buku hanya memiliki satu kategori.
        // category_id pada tabel books menjadi penghubung ke tabel categories.
        return $this->belongsTo(Category::class);
    }
}