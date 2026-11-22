<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Mengambil data buku sekaligus data kategorinya.
        // Nama relasi harus sama persis dengan method category() di model Book.
        // Cara ini disebut eager loading, supaya data kategori ikut disiapkan
        // saat daftar buku diambil.
        $books = Book::with('category')->latest()->get();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        // Mengambil semua kategori untuk ditampilkan pada dropdown form.
        $categories = Category::orderBy('name')->get();

        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',

            // Memastikan kategori yang dipilih benar-benar tersedia
            // pada kolom id di tabel categories.
            'category_id' => 'required|exists:categories,id',
        ]);

        Book::create($validated);

        return redirect('/books')->with('success', 'Buku berhasil ditambahkan.');
    }
}