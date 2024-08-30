@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb pb-0">
            <h5 class="title mb-0">Activity ({{ $activities->total() }})</h5>
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
            </div>
        </div>
    </div>
    <div class="card card-dashboard mb-4">
        <div class="card-body">
            @if (count($activities))
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date & Time</th>
                                <th>Features</th>
                                <th>Description</th>
                                <th>User</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $key => $activity)
                                <tr>
                                    <td>{{ $activities->firstItem() + $key }}</td>
                                    <td>
                                        <div>{{ date('d-m-Y', strtotime($activity->created_at)) ?? '-' }}
                                        </div>
                                        <div>{{ date('g:i:s A', strtotime($activity->created_at)) ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="text-capitalize">{{ $activity->log_name ?? '-' }}</td>
                                    <td>{{ $activity->description ?? '-' }}, ID : {{ $activity->subject_id }}</td>
                                    <td class="text-capitalize">{{ $activity->user->user_name ?? '-' }}</td>
                                    <td>{!! getActivityLogBadge($activity->event ?? '-') !!}</td>
                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $activities->links() }}
            @else
                @include('errors.no-data')
            @endif
        </div>
    </div>

@endsection
