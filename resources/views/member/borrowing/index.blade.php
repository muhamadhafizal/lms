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
                <div class="col-md-6 text-md-end text-center mt-md-0 mt-4">
                    <a href="" class="btn btn-main pt-2 pb-2 px-3 load-spinner">New
                        Borrow</a>
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
                                        <td>{{ $loans->firstItem() + $key }}</td>
                                        <td>{{ $loan->book->title }}</td>
                                        <td>{{ $loan->borrowed_at }}</td>
                                        <td>{{ $loan->due_at }}</td>
                                        <td class="text-center">
                                            <a href="" class="btn btn-main pt-2 pb-2 px-3">Return</a>
                                        </td>
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
