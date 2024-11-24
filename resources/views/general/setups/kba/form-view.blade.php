@extends('layouts.master.dashboard')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Details KBA Setup</h5>
            <li class="breadcrumb-item"><a href="{{ route( auth()->user()->getRoles()[0]. '.setups.kba.index') }}">KBA Setups</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details KBA Setup</li>
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
                        <b class="text-main">{{ $kbaForm->company->client->name ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Company</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $kbaForm->company->name ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Code</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $kbaForm->code ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Description</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $kbaForm->description ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Copy Staff Rating</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! getStatusYesNo($kbaForm->copy_staff_rating) !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Header</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $kbaForm->KBAHeaderSetups[0]->header ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Status</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! getIsActiveStatus($kbaForm->is_active) !!}</b>
                    </div>
                    <div class="col-6 col-md-3">
                    </div>
                    <div class="col-6 col-md-3">
                    </div>
                </div>
                @if ($kbaForm->kbaHeaderSetups[0]->kbaDescriptionSetups->count() > 0)
                <table class="table table-striped text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-center">Legend</th>
                            <th class="text-center">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kbaForm->kbaHeaderSetups[0]->kbaDescriptionSetups as $kbaDescriptionSetup)
                        <tr>
                            <td style="padding-bottom: 25px; padding-top: 25px;">{{$kbaDescriptionSetup->no ?? '-'}}</td>
                            <td class="text-center" style="padding-bottom: 25px; padding-top: 25px;">
                                {{ $kbaDescriptionSetup->legend ?? '-' }}
                            </td>
                            <td class="text-center" style="padding-bottom: 25px; padding-top: 25px;">
                                {{ $kbaDescriptionSetup->description ?? '-' }}
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            <div class="btn-custom-group">
                <a href="{{  route( auth()->user()->getRoles()[0].'.setups.kba.form-edit', $kbaForm) }}" class="btn btn-outline-secondary"><i
                        class="bx bxs-pencil"></i> Edit</a>
            </div>
        </div>
    </div>
    <div class="card card-dashboard">
        <div class="card-body">
            <div class="row align-items-center mb-4">
                <div class="col-md-6 d-flex justify-content-start">
                    <ol class="breadcrumb">
                        <h5 class="title">Set KBA</h5>
                    </ol>
                </div>
                @if(count($formattedKbas))
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-md-start justify-content-center flex-md-row flex-column">
                    <a href="{{  route( auth()->user()->getRoles()[0].'.setups.kba.set-edit', $kbaForm) }}" class="btn btn-outline-secondary"><i
                    class="bx bxs-pencil"></i> Edit</a>
                </div>
                @else
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-md-start justify-content-center flex-md-row flex-column">
                    <a href="{{  route( auth()->user()->getRoles()[0].'.setups.kba.set-add', $kbaForm) }}" type="button" class="btn btn-main pt-2 pb-2 px-3 me-2">
                        New Set KBA</a>
                    <a href="{{ route(  auth()->user()->getRoles()[0].'.setups.kba.set-copy', $kbaForm) }}" type="button" class="btn btn-main pt-2 pb-2 px-3">
                        Copy Set KBA</a>
                </div>
                @endif
            </div>
            <div class="row align-items-center mb-4">
                @if (count($formattedKbas))
                    <table class="table table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Weightage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formattedKbas as $kba)
                                @include('general.setups.kba.partials.kba-row', ['kba' => $kba, 'level' => 0, 'i' => $i++])
                            @endforeach
                            <tr>
                                <td style="padding-bottom: 25px; padding-top: 25px;"></td>
                                <td class="text-end" style="padding-bottom: 25px; padding-top: 25px;">
                                <strong>Total Weightage:</strong>
                                </td>
                                <td class="text-center" style="padding-bottom: 25px; padding-top: 25px;">
                                    {{ $totalWeightage }}%
                                </td>
                            </tr>
                           
                        </tbody>
                    </table>
                @else
                    @include('errors.no-data')
                @endif
            </div>
        </div>
    </div>
@endsection