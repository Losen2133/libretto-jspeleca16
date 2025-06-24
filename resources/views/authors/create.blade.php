@extends('layouts.app')

@section('content')
    <div class="card m-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Create Author</h2>
            <a href="{{ route('authors.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('authors.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create Author</button>
            </form>
        </div>
    </div>
@endsection
