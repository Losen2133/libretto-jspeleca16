<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index() {
        return Genre::all();
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);

        $genre = Genre::create([
            'name' => $request->name,
        ]);

        return response()->json($genre, 201);
    }

    public function show(Genre $genre) {
        return $genre;
    }

    public function update(Request $request, Genre $genre) {
        $this->authorize('update', $genre);
        
        $request->validate([
            'name'=> 'required|string',
        ]);

        $genre->update($request->only('name'));

        return response()->json($genre);
    }

    public function destroy(Genre $genre) {
        $this->authorize('delete', $genre);
        
        $genre->delete();

        return response()->json(null,204);
    }
}
