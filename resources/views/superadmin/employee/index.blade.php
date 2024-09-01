@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb pb-0">
            <h5 class="title mb-0">Employees ({{ $employees->count() }})</h5>
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
                    <a href="{{ route('superadmin.employee.add') }}" class="btn btn-main pt-2 pb-2 px-3 load-spinner">New
                        Employee</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-dashboard mb-4">
        <div class="card-body">
            @if (count($employees))
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Client</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $key => $employee)
                                <tr>
                                    <td>{{ $employees->firstItem() + $key }}</td>
                                    <td class="text-center text-capitalize">{{ $employee->companies->first()->client->name ?? '-' }}</td>
                                    <td class="text-center text-capitalize">
                                        @if($employee->companies->isNotEmpty())
                                            @foreach($employee->companies as $company)
                                                {{ $company->name }}{{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center text-capitalize">{{ $employee->user_name ?? '-' }}</td>
                                    <td class="text-center">{{ $employee->user_email ?? '-' }}</td>
                                    <td class="text-center">{!! getRoleBadge($employee->getRoles()[0]) !!}</td>
                                    <td class="text-center">{!! getIsActiveStatus($employee->user_status) !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('superadmin.employee.view', $employee) }}"
                                                class="btn btn-outline-main" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Client Details"><i class="bx bxs-show"></i></a>
                                        <a href="#"
                                            class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit-staff-modal-{{ $key }}"><i 
                                                class="bx bxs-pencil"></i></a>
                                        <a href="#"
                                            class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#resend-employee-modal-{{ $key }}"><i
                                            class="bx bx-refresh"></i></a>
                                            @include ('superadmin.employee.modal-resend')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $employees->links() }}
            @else
                @include('errors.no-data')
            @endif
        </div>
    </div>
@endsection