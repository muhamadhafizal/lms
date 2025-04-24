@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb pb-0">
            <h5 class="title mb-0">Borrowing</h5>
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
                </div>
            </div>
        </div>
    </div>

    <div class="card card-dashboard mb-4">
        <div class="card-body">
            @if (count($loans))
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Book</th>
                                    <th class="text-center">Borrowed At</th>
                                    <th class="text-center">Due At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loans as $key => $loan)
                                    <tr>
                                        <td class="text-center">{{ $loans->firstItem() + $key }}</td>
                                        <td class="text-center">{{ $loan->book->title }}</td>
                                        <td class="text-center">{{ $loan->borrowed_at }}</td>
                                        <td class="text-center">{{ $loan->due_at }}</td>
                                        <td class="text-center">
                                            <div>
                                                <a class="btn" data-bs-target="#return-modal-{{ $key }}" data-bs-toggle="modal">
                                                    <u class="text-primary fw-bold">Return</u>
                                                </a>
                                            </div>
                                        </td>
                                        @include('member.borrowing.modal.return')
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
                {{ $loans->links() }}
            @else
                @include('errors.no-data')
            @endif
        </div>
    </div>

@endsection
