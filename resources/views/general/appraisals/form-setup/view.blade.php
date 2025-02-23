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
    
    <div class="card card-dashboard mb-4">
        <div class="card-body">
            <div class="row align-items-center mb-4">
                <div class="col-md-6 d-flex justify-content-start">
                    <ol class="breadcrumb">
                        <h5 class="title">Appraisal Form (Part)</h5>
                    </ol>
                </div>
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-md-start justify-content-center flex-md-row flex-column">
                    <a href="#" type="button" class="btn btn-main pt-2 pb-2 px-3 me-2"
                        data-bs-toggle="modal" data-bs-target="#modal-part-add">
                        Add Appraisal Set
                    </a>
                    @if($appraisalParts->isEmpty())
                    <a href="" type="button" class="btn btn-main pt-2 pb-2 px-3">
                        Copy Appraisal Set</a>
                    @endif
                </div>
            </div>
            <div class="row align-items-center mb-4">
                @if (count($appraisalParts))
                    <div class="table-responsive">
                        <table class="table table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">Target</th>
                                    <th class="text-center">Part Title</th>
                                    <th class="text-center">Weightage</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appraisalParts as $key =>$appraisalPart)
                                    <tr>
                                        <td class="text-center">
                                            {{ $appraisalPart->related_model?->{$appraisalPart->model === 'KRA' ? 'name' : 'code'} ?? $appraisalPart->model }}
                                        </td>
                                        <td class="text-center">{{ $appraisalPart->title }}</td>
                                        <td class="text-center">{{ $appraisalPart->weightage }}%</td>
                                        <td class="text-center">
                                            <a href=""
                                                class="btn btn-outline-secondary"
                                                data-bs-toggle="modal" data-bs-target="#modal-part-edit-{{ $key }}"><i
                                                    class="bx bxs-pencil"></i></a>
                                                @include('general.appraisals.form-setup.modal.modal-part-edit')
                                            <a href="{{  route( auth()->user()->getRoles()[0].'.appraisals.form-setups.part-delete', $appraisalPart) }}"
                                                class="btn btn-outline-danger confirm-delete" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="delete Appraisal Setup"><i
                                                    class="bx bxs-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                <td ></td>
                                <td class="text-center">
                                <strong>Total Weightage :</strong>
                                </td>
                                <td class="text-center">
                                    <strong>{{ $appraisalParts->sum('weightage') }}%</strong>
                                </td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    @include('errors.no-data')
                @endif
            </div>
        </div>
    </div>

    <div class="card card-dashboard">
        <div class="card-body">
            <div class="row align-items-center mb-4">
                <div class="col-md-6 d-flex justify-content-start">
                    <ol class="breadcrumb">
                        <h5 class="title">Invite Staff</h5>
                    </ol>
                </div>
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-md-start justify-content-center flex-md-row flex-column">
                    <a href="#" type="button" class="btn btn-main pt-2 pb-2 px-3 me-2"
                        data-bs-toggle="modal" data-bs-target="#modal-staff-add">
                        Add Staff
                    </a>
                </div>
            </div>
            <div class="row align-items-center mb-4">
                @if (count($appraisalStaffs))
                    <div class="table-responsive">
                        <table class="table table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Company Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appraisalStaffs as $key =>$staff)
                                    <tr>
                                        <td class="text-center">
                                            {{ $staff->user->user_name }}
                                        </td>
                                        <td class="text-center">{!! getRoleBadge($staff->user->getRoles()[0]) !!}</td>
                                        <td class="text-center">
                                        @if($staff->user->companies->isNotEmpty())
                                            @foreach($staff->user->companies as $company)
                                                {{ $company->name }}{{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{  route( auth()->user()->getRoles()[0].'.appraisals.form-setups.staff-delete', $staff) }}"
                                                class="btn btn-outline-danger confirm-delete" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Remove Staff"><i
                                                    class="bx bxs-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    @include('errors.no-data')
                @endif
            </div>
        </div>
    </div>
    @include ('general.appraisals.form-setup.modal.modal-part-add')
    @include ('general.appraisals.form-setup.modal.modal-staff-add')
@endsection