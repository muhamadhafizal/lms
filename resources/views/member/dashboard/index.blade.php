@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb pb-0">
            <h5 class="title mb-0">Dashboard</h5>
        </ol>
    </nav>
    <div class="row row-cols-lg-2 row-cols-2 px-2">
        <div class="col mb-3">
            <div class="card shadow-sm border-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Available Books</h5>
                    <h2>{{ $availableBooks }}</h2>
                </div>
            </div>
        </div>

        <div class="col mb-3">
            <div class="card shadow-sm border-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Borrowed Books</h5>
                    <h2>{{ $borrowedBooks }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Recent Books Borrowed</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th>Borrower</th>
                            <th>Borrowed Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($currentBorrowedBooks as $index => $book)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->isbn }}</td>
                                <td>{{ $book->borrower_name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($book->borrowed_at)->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No borrowed books found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection