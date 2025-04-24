<div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h1 class="modal-title fs-5">Add New Book</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('member.book.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Author</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="AVAILABLE" selected>AVAILABLE</option>
                            <option value="BORROWED">BORROWED</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Book</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>

        </div>
    </div>
</div>
