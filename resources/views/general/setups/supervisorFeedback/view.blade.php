@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Supervisor Feedback Setup Details</h5>
            <li class="breadcrumb-item"><a href="{{ route( auth()->user()->getRoles()[0]. '.setups.supervisor-feedback.index') }}">Supervisor Feedback Setups</a></li>
            <li class="breadcrumb-item active" aria-current="page">Supervisor Feedback Setup Details</li>
        </ol>
    </nav>
    <div class="card card-dashboard mb-4">
        <div class="card-body">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Client</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $supervisorFeedback->company->client->name ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Company</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $supervisorFeedback->company->name ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Code</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $supervisorFeedback->code ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Description</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $supervisorFeedback->description ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Status</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! getIsActiveStatus($supervisorFeedback->is_active) !!}</b>
                    </div>
                </div>

            </div>
            <div class="btn-custom-group">
                <a href="{{ route(auth()->user()->getRoles()[0].'.setups.supervisor-feedback.edit', $supervisorFeedback) }}" class="btn btn-outline-secondary"><i
                        class="bx bxs-pencil"></i> Edit</a>
            </div>
        </div>
    </div>
    <div class="card card-dashboard">
        <div class="card-body">
            <div class="row align-items-center mb-4">
                <div class="col-md-6 d-flex justify-content-start">
                    <ol class="breadcrumb">
                        <h5 class="title">List Of Questions</h5>
                    </ol>
                </div>
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-md-start justify-content-center flex-md-row flex-column">
                    <a href="" type="button" class="btn btn-main pt-2 pb-2 px-3"
                        data-bs-toggle="modal" data-bs-target="#add-supervisor-question-modal">
                        New Question</a>
                </div>
            </div>   
            @if(count($supervisorFeedback->questions))   
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Question</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($supervisorFeedback->questions as $key => $ques)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $ques->question ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="" type="button" class="btn btn-outline-main"
                                        data-bs-toggle="modal" data-bs-target="#edit-supervisor-question-modal-{{ $key }}"><i
                                            class="bx bxs-pencil"></i></a>
                                    @include('general.setups.supervisorFeedback.modal-edit-question')
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                @include('errors.no-data')
            @endif
        </div>
    </div>
    @include ('general.setups.supervisorFeedback.modal-add-question')
@endsection