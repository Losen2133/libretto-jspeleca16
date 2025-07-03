@extends('layouts.app')

@section('content')
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Book Details</h2>
            <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
        </div>
        <div class="card-body">
            <h4 class="mb-3">{{ $book->title }}</h4>

            <p><strong>Author:</strong> {{ $book->author->name }}</p>

            <p><strong>Genres:</strong>
                @if($book->genres->isNotEmpty())
                    @foreach ($book->genres as $genre)
                        <span class="badge bg-secondary">{{ $genre->name }}</span>
                    @endforeach
                @else
                    <span class="text-muted">No genres listed</span>
                @endif
            </p>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <p><strong>Reviews Count:</strong> {{ $book->reviews->count() }}</p>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">Add Review</button>
            </div>
            @if($reviews->count())
                <hr>
                <h5>Reviews ({{ $book->reviews->count() }})</h5>    
                
                <ul class="list-group mb-3">
                    @foreach($reviews as $review)
                        <li class="list-group-item">
                            <div class="d-flex align-items-center justify-content-between">
                                <span>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="bi bi-star-fill" style="color:gold;"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <span>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editReviewModal"><i class="bi bi-pencil-square"></i></button>
                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Do you want to delete this review?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </span>
                                
                            </div>
                            {{ $review->content }}
                        </li>
                        @include('books.partials.edit-review-modal')
                    @endforeach
                </ul>
                {{ $reviews->links() }}
            @else
                <p class="text-muted">No reviews available.</p>
            @endif

        </div>
    </div>
    @include('books.partials.create-review-modal')
@endsection


