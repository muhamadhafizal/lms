@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb pb-0">
            <h5 class="title mb-0">Supervisor Feedback ({{ $supervisorFeedbacks->total() }})</h5>
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
                    <a href="{{ route( auth()->user()->getRoles()[0]. '.setups.supervisor-feedback.add') }}" class="btn btn-main pt-2 pb-2 px-3 load-spinner">New
                        Feedback</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-dashboard mb-4">
        <div class="card-body">
            @if (count($supervisorFeedbacks))
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Code</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">No.Question</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($supervisorFeedbacks as $key => $supervisorFeedback)
                            <tr>
                                <td>{{ $supervisorFeedbacks->firstItem() + $key }}</td>
                                <td class="text-center">{{ $supervisorFeedback->company->name ?? '-' }}</td>
                                <td class="text-center">{{ $supervisorFeedback->code ?? '-' }}</td>
                                <td class="text-center">{{ $supervisorFeedback->description ?? '-' }}</td>
                                <td class="text-center">{{ count($supervisorFeedback->questions) }}</td>
                                <td class="text-center">{!! getIsActiveStatus($supervisorFeedback->is_active) !!}</td>
                                <td class="text-center">
                                    <a href="{{ route( auth()->user()->getRoles()[0].'.setups.supervisor-feedback.view', $supervisorFeedback) }}"
                                            class="btn btn-outline-main" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="View Supervisor Feedback"><i
                                                class="bx bxs-show"></i></a>
                                </td>
                          @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $supervisorFeedbacks->links() }}
            @else
                @include('errors.no-data')
            @endif
        </div>
    </div>

@endsection
