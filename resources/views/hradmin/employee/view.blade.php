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
                        <label for="form-label">Supervisor</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">
                            @if($employee->employee->supervisors->isNotEmpty())
                                @foreach($employee->employee->supervisors as $supervisor)
                                   Supervisor {{ $supervisor->level }} : {{ $supervisor->supervisor->user->user_name }}<br>
                                @endforeach
                            @else
                                No Supervisors Assigned.
                            @endif
                        </b>
                    </div>
                    @if($employee->getRoles()[0] == 'hradmin')
                        <div class="col-6 col-md-3">
                            <label for="form-label">User Security Group</label>
                        </div>
                        <div class="col-6 col-md-3">
                            <b class="text-main">
                            @if($employee->securityGroups->isNotEmpty())
                                {{-- Loop through the security groups and display their names --}}
                                    @foreach($employee->securityGroups as $securityGroup)
                                        {{ $securityGroup->name }}<br>
                                    @endforeach
                            @else
                                No security groups assigned.
                            @endif
                            </b>
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Security Group</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->securityGroup->name ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Employee No</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->employee_id ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Short Name</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->short_name ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Date Of Birth</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->dob ? date('d-m-Y', strtotime($employee->employee->dob)) : '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Gender</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->gender ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Marital Status</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->marital_status ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Home No</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->home_no ?? '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Mobile No</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->mobile_no ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Group Join Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">
                            {{ $employee->employee->group_join_date ? date('d-m-Y', strtotime($employee->employee->group_join_date)) : '-' }}
                        </b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Join Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->join_date ? date('d-m-Y', strtotime($employee->employee->join_date)) : '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Confirm Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->confirm_date ? date('d-m-Y', strtotime($employee->employee->confirm_date )) : '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Increment Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->increment_date ? date('d-m-Y', strtotime($employee->employee->increment_date)) : '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Resign Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->resign_date ? date('d-m-Y', strtotime($employee->employee->resign_date )) : '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Retire Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->retire_date ? date('d-m-Y', strtotime($employee->employee->retire_date)) : '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Probation End Date</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->probation_end_date ? date('d-m-Y', strtotime($employee->employee->probation_end_date )) : '-' }}</b>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 col-md-3">
                        <label for="form-label">Work Type</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->work_type ?? '-' }}</b>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="form-label">Designation</label>
                    </div>
                    <div class="col-6 col-md-3">
                        <b class="text-main">{{ $employee->employee->designation ?? '-' }}</b>
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
                <a href="{{ route('hradmin.employee.edit',$employee) }}" class="btn btn-outline-secondary"><i
                        class="bx bxs-pencil"></i> Edit</a>
            </div>
        </div>
    </div>
@endsection