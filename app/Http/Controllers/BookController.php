<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\View\View;
use App\Models\Author;
use App\Models\Genre;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("books.index", [
            'books' => Book::latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('books.create', [
            'authors' => Author::all(),
            'genres' => Genre::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
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

        return redirect()->route('books.index')->withSuccess('New book added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): View
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book): View
{
    return view('books.edit', [
        'book' => $book,
        'authors' => Author::all(),
        'genres' => Genre::all(),
    ]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        $request->validate([
        'title' => 'required',
        'author_id' => 'required|exists:authors,id',
        'genres' => 'required|array',
        'genres.*' => 'exists:genres,id',
    ]);

    $book->update([
        'title' => $request->title,
        'author_id' => $request->author_id,
    ]);

    $book->genres()->sync($request->genres);

    return redirect()->route('books.index')->withSuccess('Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('books.index')->withSuccess('Book is deleted successfully');
    }
}
