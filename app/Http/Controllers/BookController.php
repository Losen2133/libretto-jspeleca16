<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\View\View;

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
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title'=> 'required',
            'author_id' => 'required',
        ]);

        $book = Book::create([
            'title'=> $request->title,
            'author_id'=> $request->author_id,
        ]);

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
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        $request->validate([
            'title'=> 'required',
            'author_id' => 'required',
        ]);

        $book->update([
            'title'=> $request->title,
            'author_id'=> $request->author_id,
        ]);

        return redirect()->back()->withSuccess('Book is updated successfully');
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
