<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $allowedFilters = [
            'title',
            'author',
            'genre',
            'pages',
            'price',
        ];

        $query = Book::query();

        foreach ($allowedFilters as $field) {
            if ($request->filled($field)) {
                $query->where($field, $request->input($field));
            }
        }

        return response()->json($query->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'pages' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $book = Book::create($validated);

        return response()->json($book, 201);
    }

    public function show(Book $book)
    {
        return response()->json($book, 200);
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'genre' => 'sometimes|required|string|max:100',
            'pages' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $book->update($validated);

        return response()->json($book, 200);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->noContent();
    }
}