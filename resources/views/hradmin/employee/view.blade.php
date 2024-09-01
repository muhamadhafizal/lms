@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Employee Details</h5>
            <li class="breadcrumb-item"><a href="{{ route('hradmin.employee.index') }}">Employees</a></li>
            <li class="breadcrumb-item active" aria-current="page">Employee Details</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Client Name</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->companies->first()->client->name ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Company Name</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">
                            @if($employee->companies->isNotEmpty())
                                @foreach($employee->companies as $company)
                                    {{ $company->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            @else
                                -
                            @endif
                        </b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Name</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->user_name ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Email</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->user_email ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Language</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->user_language ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Status</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! getIsActiveStatus($employee->user_status) !!}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Role</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! getRoleBadge($employee->getRoles()[0]) !!}</b>
                    </div>
                </div>
            </div>

            <div class="btn-custom-group">
                <a href="{{ route('hradmin.employee.edit',$employee) }}" class="btn btn-outline-secondary"><i
                        class="bx bxs-pencil"></i> Edit</a>
            </div>
        </div>
    </div>
@endsection