<form action="{{ route('reviews.update', $review) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="editReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editReviewModalLabel">Edit Review</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="book_id" value="{{ $review->book_id }}">

                    <div class="mb-3">
                        <label for="edit-rating" class="form-label">Rating (1–5)</label>
                        <select name="rating" id="edit-rating" class="form-select">
                            <option value="" disabled>-- Select Rating --</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-content" class="form-label">Review</label>
                        <textarea name="content" id="edit-content" class="form-control" rows="4">{{ old('content', $review->content) }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Review</button>
                </div>
            </div>
        </div>
    </div>
</form>
