<div class="modal fade" id="return-modal-{{ $key }}" tabindex="-1" aria-hidiven="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex align-items-center justify-content-center">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Book Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-start">
                <div class="d-flex mb-2">
                    <div class="me-2 fw-bold">Title:</div>
                    <div>{{ $loan->book->title }}</div>
                </div>

                <div class="d-flex mb-2">
                    <div class="me-2 fw-bold">Author:</div>
                    <div>{{ $loan->book->author }}</div>
                </div>

                <div class="d-flex mb-2">
                    <div class="me-2 fw-bold">ISBN:</div>
                    <div>{{ $loan->book->isbn }}</div>
                </div>

                <div class="d-flex mb-2">
                    <div class="me-2 fw-bold">Status:</div>
                    <div>
                        <span class="badge bg-{{ $loan->book->status === 'AVAILABLE' ? 'success' : 'secondary' }}">
                            {{ $loan->book->status }}
                        </span>
                    </div>
                </div>

                <div class="d-flex mb-2">
                    <div class="me-2 fw-bold">Borrowed At:</div>
                    <div>
                        <span>
                            {{ $loan->borrowed_at }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <form action="{{ route('member.borrowing.return', $loan) }}" method="POST">
                    @csrf
                    <input type="text" name="book_id" value="{{ $loan->book->id }}" hidden>
                    <button type="submit" class="btn btn-primary">
                        Confirm Return Book
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>