<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'book_id' => 'required|exists:books,id',    
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::create([
            'book_id' => $request->book_id,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return response()->json($review, 201);
    }

    public function update(Request $request, Review $review) {
        $this->authorize('update', $review);

        $request->validate([
            'book_id' => 'required|exists:books,id', 
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->update([
            'book_id' => $request->book_id,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return response()->json($review);
    }

    public function destroy(Review $review) {
        $this->authorize('delete', $review);

        $review->delete();

        return response()->json(null, 204);
    }


}
