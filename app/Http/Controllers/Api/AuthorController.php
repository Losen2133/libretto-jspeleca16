<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index() {
        return Author::with('books')->get();
    }

    public function store(Request $request) {
        $request->validate([
            'name'=> 'required|string',
        ]);

        $author = Author::create([
            'name'=> $request->name
        ]);

        return response()->json($author, 201);
    }

    public function show(Author $author) {
        return $author->load('books');
    }

    public function update(Request $request, Author $author) {
        $this->authorize('update', $author);
        
        $request->validate([
            'name'=> 'required|string',
        ]);

        $author->update($request->only('name'));

        return response()->json($author);
    }

    public function destroy(Author $author) {
        $this->authorize('delete', $author);
        
        $author->delete();

        return response()->json(null,204);
    }
}
