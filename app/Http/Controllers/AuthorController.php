<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("authors.index", [
            'authors' => Author::latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'=> 'required',
        ]);

        $author = Author::create([
            'name'=> $request->name
        ]);

        return redirect()->route('authors,index')->withSuccess('New author added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author): View
    {
        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author): View
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author): RedirectResponse
    {
        $request->validate([
            'name'=> 'required',
        ]);

        $author->update([
            'name'=> $request->name
        ]);

        return redirect()->back()->withSuccess('Author is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();

        return redirect()->route('authors.index')->withSuccess('Author is deleted successfully');
    }
}
