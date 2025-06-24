<form action="{{ route('reviews.store', $book) }}" method="POST">
    @csrf
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Review</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Rating --}}
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (1-5)</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="" disabled selected>-- Select Rating --</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Review Content --}}
                    <div class="mb-3">
                        <label for="content" class="form-label">Review</label>
                        <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </div>
        </div>
    </div>
</form>
