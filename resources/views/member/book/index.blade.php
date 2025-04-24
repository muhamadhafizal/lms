@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb pb-0">
            <h5 class="title mb-0">List of Books ({{ $books->count() }})</h5>
        </ol>
    </nav>

    <div class="card card-dashboard mb-4">
        <div class="card-body">
            <div class="row align-items-center mb-4">
                <div class="col-md-6 d-flex justify-content-start">
                    <form action="" method="get">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control" placeholder="Search.."
                                value="{{ $request->search }}">
                            <button class="btn btn-main" type="submit">Search</button>
                        </div>
                    </form>
                    <a href="javascript:void(0);"
                        class="btn btn-outline-main px-3 d-flex align-items-center justify-content-center ms-2"
                        data-bs-toggle="modal" data-bs-target="#filterAirlineModal">
                        <i class="bx bxs-filter-alt"></i>
                    </a>
                </div>
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-center flex-md-row flex-column">
                    <button type="button"
                        class="btn btn-main px-3 d-flex align-items-center justify-content-center ms-md-2 mt-lg-0 mt-4"
                        data-bs-toggle="modal" data-bs-target="#addBookModal" style="height:50px">
                        Add New Book
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Author</th>
                            <th class="text-center">ISBN</th>
                            <th class="text-center">Availability</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $key => $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        {{ $book->title }}
                                    </td>
                                    <td class="text-center">
                                        {{ $book->author }}
                                    </td>
                                    <td class="text-center">
                                        {{ $book->isbn }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $book->status === 'AVAILABLE' ? 'success' : 'secondary' }}">
                                            {{ $book->status }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div>
                                            <a class="btn" data-bs-target="#borrow-modal-{{ $key }}" data-bs-toggle="modal">
                                                <u class="text-primary fw-bold">Book</u>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @include('member.book.modal.borrow')
                        @endforeach
                </table>
            </div>
        </div>
    </div>
    @include('member.book.modal.add')
@endsection