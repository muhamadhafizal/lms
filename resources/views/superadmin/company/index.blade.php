@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb pb-0">
            <h5 class="title mb-0">Companies ({{ $companies->total() }})</h5>
        </ol>
    </nav>
    <div class="card card-dashboard-top mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 d-flex justify-content-start">
                    <form action="" method="get">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control" placeholder="Search.."
                                value="{{ $request->search }}">
                            <button class="btn btn-main" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-md-start justify-content-center flex-md-row flex-column">
                    <a href="" class="btn btn-main pt-2 pb-2 px-3 load-spinner">New
                        Company</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-dashboard mb-4">
        <div class="card-body">
            @if (count($companies))

                {{ $companies->links() }}
            @else
                @include('errors.no-data')
            @endif
        </div>
    </div>

@endsection
