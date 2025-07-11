<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("reviews.index", [
            'reviews' => Review::latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',    
            'content' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'book_id' => $request->book_id,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->withSuccess('New review added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review): View
    {
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review): View
    {
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review): RedirectResponse
    {
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

        return redirect()->back()->withSuccess('Review updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return redirect()->back()->withSuccess('Review deleted successfully');
    }
}
