@extends('layouts.app')

@section('content')
<div class="card m-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Add New Book</span>
        <a href="{{ session('previous-route') }}" class="btn btn-primary btn-sm">&larr; Back</a>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-center align-items-center">

            <form action="{{ route('books.store') }}" method="POST" class="w-50">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <div class="form-text">Provide the title of the book</div>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="author_id" class="form-label">Author</label>
                    <div class="form-text">Select the author of the book.</div>
                    <select name="author_id" id="author_id" class="form-select">
                        <option value="" disabled {{ old('author_id', $selectedAuthor->id ?? '') ? '' : 'selected' }}>-- Select Author --</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}"
                                {{ (old('author_id') == $author->id || (isset($selectedAuthor) && $selectedAuthor->id == $author->id)) ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('author_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="genres[]" class="form-label">Genres</label>
                    <div class="form-text">Select the genres of the book.</div>
                    <select name="genres[]" id="genres" class="form-select" multiple>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}" {{ collect(old('genres'))->contains($genre->id) ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('genres')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <button type="button" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#genreModal">
                        Manage Genres
                    </button>
                </div>

                <button type="submit" class="btn btn-primary">Add Book</button>
            </form>

        </div>
    </div>
</div>

@include('books.partials.create-genre-modal')

@if ($errors->has('name'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const genreModal = new bootstrap.Modal(document.getElementById('genreModal'));
            genreModal.show();
        });
    </script>
@endif
@endsection
