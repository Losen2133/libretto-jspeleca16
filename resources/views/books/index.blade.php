@extends('layouts.app')

@section('content')
    <div class="card m-5">
        <div class="card-header justify-content-between d-flex align-items-center">
            <h2>Books</h2> <a href="{{ route('books.create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="card-body table-responsive">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered table-hover w-100">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Genres</th>
                        <th scope="col" class="text-center">Reviews Count</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author->name }}</td>
                            <td>
                                @foreach ($book->genres as $genre)
                                    <span class="badge bg-secondary">{{ $genre->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-center">{{ $book->reviews->count() }}</td>
                            <td class="text-center">
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Do you want to delete this book?');">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No books available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $books->links() }}
        </div>
    </div>
@endsection
