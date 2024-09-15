@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Employee Details</h5>
            <li class="breadcrumb-item"><a href="{{ route('superadmin.employee.index') }}">Employees</a></li>
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
                        <label for="form-label">Role</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{!! getRoleBadge($employee->getRoles()[0]) !!}</b>
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
                        <label for="form-label">Language</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->user_language ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Race</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->race->name ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Religion</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->religion->name ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Nationality</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->nationality->name ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Work Location</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->workLocation->name ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Cost Centre</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->costCentre->name ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Department</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->department->name ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Section</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->section->name ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Category</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->category->name ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Job Grade</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->jobGrade->name ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Business Unit</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->businessUnit->name ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Qualification</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->qualification->name ?? '-' }}</b>
                    </div>
                </div>
            </div>

            <div class="btn-custom-group">
                <a href="{{ route('superadmin.employee.edit',$employee) }}" class="btn btn-outline-secondary"><i
                        class="bx bxs-pencil"></i> Edit</a>
            </div>
        </div>
    </div>
@endsection