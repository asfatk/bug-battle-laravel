<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function books()
    {
        // Satu kategori bisa memiliki banyak buku.
        // Laravel akan mencari buku-buku yang category_id-nya sesuai
        // dengan id kategori ini.
        return $this->hasMany(Book::class);
    }
}