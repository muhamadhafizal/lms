@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb pb-0">
            <h5 class="title mb-0">Central HR Staffs ( {{$staffs->count()}} )</h5>
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
                    <a href="#" type="button" class="btn btn-main pt-2 pb-2 px-3"
                        data-bs-toggle="modal" data-bs-target="#add-staff-modal">
                        New Staff
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-dashboard mb-4">
        <div class="card-body">
            @if (count($staffs))
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staffs as $key => $staff)
                                <tr>
                                    <td>{{ $staffs->firstItem() + $key }}</td>
                                    <td class="text-center">{{ $staff->user_name ?? '-' }}</td>
                                    <td class="text-center">{{ $staff->user_email ?? '-' }}</td>
                                    <td class="text-center">{!! getIsActiveStatus($staff->user_status) !!}</td>
                                    <td class="text-center">
                                        <a href="#"
                                            class="btn btn-outline-main" data-bs-toggle="modal" data-bs-target="#view-staff-modal-{{ $key }}"><i
                                                class="bx bxs-show"></i></a>
                                            @include ('superadmin.user.modal-view')
                                        <a href="#"
                                            class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit-staff-modal-{{ $key }}"><i 
                                                class="bx bxs-pencil"></i></a>
                                            @include ('superadmin.user.modal-edit')
                                        <a href=""
                                            class="btn btn-outline-secondary" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="Resend Invitation"><i
                                            class="bx bx-refresh"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $staffs->links() }}
            @else
                @include('errors.no-data')
            @endif
        </div>
    </div>
    @include ('superadmin.user.modal-add')
@endsection