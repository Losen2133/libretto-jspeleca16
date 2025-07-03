<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        return Book::with('author', 'genres', 'reviews')->get();
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book = Book::create([
            'title'=> $request->title,
            'author_id'=> $request->author_id,
        ]);

        $book->genres()->attach($request->genres);

        return response()->json($book, 201);
    }

    public function show(Book $book) {
        return $book->load('author', 'genres', 'reviews');
    }

    public function update(Request $request, Book $book) {
        $this->authorize('update', $book);

        $request->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book->update([
            $request->title,
            'author_id' => $request->author_id,
        ]);

        $book->genres()->sync($request->genres);

        return response()->json($book);
    }

    public function destroy(Book $book) {
        $this->authorize('delete', $book);
        
        $book->delete();

        return response()->json(null,204);
    }
}
