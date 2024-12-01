@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Details Form Setup</h5>
            <li class="breadcrumb-item"><a href="{{ route( auth()->user()->getRoles()[0]. '.appraisals.form-setups.index') }}">Form Setups</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details Form Setup</li>
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
                        <b class="text-main">{{ $appraisalSetup->company->client->name ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Company</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $appraisalSetup->company->name ?? '-' }}</b>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Code</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $appraisalSetup->code ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Description</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $appraisalSetup->description ?? '-' }}</b>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Category</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $appraisalSetup->category ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Batch</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $appraisalSetup->batch->code ?? '-' }}</b>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Review Start Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ \Carbon\Carbon::parse($appraisalSetup->review_start_date)->format('d/m/Y') ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Review End Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ \Carbon\Carbon::parse($appraisalSetup->review_end_date)->format('d/m/Y') ?? '-' }}</b>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Rating Start Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ \Carbon\Carbon::parse($appraisalSetup->rating_start_date)->format('d/m/Y') ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Rating End Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ \Carbon\Carbon::parse($appraisalSetup->rating_end_date)->format('d/m/Y') ?? '-' }}</b>
                    </div>
                </div>
           
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Status</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! getIsActiveStatus($appraisalSetup->is_active) !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                    </div>
                    <div class="col-6 col-md-3">
                    </div>
                </div>
            </div>
            <div class="btn-custom-group">
                <a href="{{  route( auth()->user()->getRoles()[0].'.appraisals.form-setups.edit', $appraisalSetup) }}" class="btn btn-outline-secondary"><i
                        class="bx bxs-pencil"></i> Edit</a>
            </div>
        </div>
    </div>
    <div class="card card-dashboard">
        <div class="card-body">
            <div class="row align-items-center mb-4">
                <div class="col-md-6 d-flex justify-content-start">
                    <ol class="breadcrumb">
                        <h5 class="title">Appraisal Form (Part)</h5>
                    </ol>
                </div>
                @if(count($appraisalParts))
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-md-start justify-content-center flex-md-row flex-column">
                    <a href="" class="btn btn-outline-secondary"><i
                    class="bx bxs-pencil"></i> Edit</a>
                </div>
                @else
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-md-start justify-content-center flex-md-row flex-column">
                    <a href="" type="button" class="btn btn-main pt-2 pb-2 px-3 me-2">
                        New Appraisal Set</a>
                    <a href="" type="button" class="btn btn-main pt-2 pb-2 px-3">
                        Copy Appraisal Set</a>
                </div>
                @endif
            </div>
            <div class="row align-items-center mb-4">
                @if (count($appraisalParts))

                @else
                    @include('errors.no-data')
                @endif
            </div>
        </div>
    </div>

@endsection