@extends('layouts.app')

@section('content')
    <h2>Authors</h2>

    <ul>
        @forelse($authors as $author)
            <li>{{ $author->name }}</li>
        @empty
            <li>No Authors Found</li>
        @endforelse
    </ul>
    {{ $authors->links() }}
@endsection
