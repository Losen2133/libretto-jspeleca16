<!-- ✅ Genre Create Modal -->
<div class="modal fade" id="genreModal" tabindex="-1" aria-labelledby="genreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Wider modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="genreModalLabel">Add Genre</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <!-- ✅ Genre Create Form -->
                <form id="genre-form" action="{{ route('genres.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Genre Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer p-0 mb-3">
                        <button type="submit" class="btn btn-primary">Add Genre</button>
                    </div>
                </form>

                <!-- ✅ Genre List with Delete Buttons -->
                <h5 class="mt-4">Existing Genres</h5>
                <ul class="list-group">
                    @forelse ($genres as $genre)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $genre->name }}

                            <!-- Individual Delete Form (not nested) -->
                            <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" onsubmit="return confirm('Delete genre {{ $genre->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">No genres found.</li>
                    @endforelse
                </ul>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
