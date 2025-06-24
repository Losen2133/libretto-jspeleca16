@extends('layouts.app')

@section('content')
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Edit Author</h2>
            <a href="{{ route('authors.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('authors.update', $author->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $author->name) }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Author</button>
            </form>
        </div>
    </div>
@endsection
