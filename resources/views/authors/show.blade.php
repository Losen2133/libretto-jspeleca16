@extends('layouts.app')

@section('content')
<div class="card m-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>Author Details</h2>
        <div>
            <a href="{{ route('authors.index') }}" class="btn btn-sm btn-primary">
                &larr; Back
            </a>
        </div>
    </div>

    <div class="card-body">
        <h4>{{ $author->name }}</h4>

        <hr>

        <div class="d-flex justify-content-between mb-3">
            <h5>Books</h5> <a href="{{ route('books.create.with.author', $author) }}" class="btn btn-sm btn-primary">Add</a>
        </div>
        @if ($author->books->isEmpty())
            <p class="text-muted">This author has no books yet.</p>
        @else
            <ul class="list-group">
                @foreach ($author->books as $book)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a>
                        <span>
                            @foreach($book->genres as $genre)
                                <span class="badge bg-secondary">{{ $genre->name }}</span>
                            @endforeach
                        </span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
