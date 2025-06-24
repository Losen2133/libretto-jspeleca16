@extends('layouts.app')

@section('content')
<div class="card m-5">
    <div class="card-header justify-content-between d-flex align-items-center">
        <h2>Authors</h2> 
        <a href="{{ route('authors.create') }}" class="btn btn-primary">Add</a>
    </div>

    <div class="card-body">
        <div class="accordion" id="authorAccordion">
            @forelse($authors as $author)
                <div class="accordion-item mb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="accordion-button collapsed flex-grow-1 text-start" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $author->id }}"
                            aria-expanded="false" aria-controls="collapse-{{ $author->id }}">
                            {{ $author->name }}
                        </button>

                        <div class="ms-2 me-3 d-flex align-items-center gap-2">
                            <a href="{{ route('authors.show', $author->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></a>
                            <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this author?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>

                    <div id="collapse-{{ $author->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading-{{ $author->id }}" data-bs-parent="#authorAccordion">
                        <div class="accordion-body">
                            <strong>Authored Books</strong>
                            @if ($author->books->isEmpty())
                                <p class="text-muted mt-2">No books found for this author.</p>
                            @else
                                <ul class="list-group mt-2">
                                    @foreach($author->books as $book)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No Authors Found</p>
            @endforelse
        </div>
    </div>

    <div class="card-footer">
        {{ $authors->links() }}
    </div>
</div>
@endsection
