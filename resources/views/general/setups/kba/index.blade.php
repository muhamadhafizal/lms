@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb pb-0">
            <h5 class="title mb-0">KBA Setup</h5>
        </ol>
    </nav>
    <div class="card card-dashboard-top mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 d-flex justify-content-start">
                    <form action="" method="get">
                        <div class="input-group">
                            <input name="search" type="text" class="form-control" placeholder="Search.."
                                value="">
                            <button class="btn btn-main" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-md-start justify-content-center flex-md-row flex-column">
                    <a href="{{ route( auth()->user()->getRoles()[0]. '.setups.kba.form-add') }}" class="btn btn-main pt-2 pb-2 px-3 load-spinner">New
                        KBA Setup</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-dashboard mb-4">
        <div class="card-body">
            @if (count($kbaForms))
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Code</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Copy Staff Rating</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($kbaForms as $key => $kbaForm)
                            <tr>
                                <td>{{ $kbaForms->firstItem() + $key }}</td>
                                <td class="text-center">{{ $kbaForm->company->name ?? '-' }}</td>
                                <td class="text-center">{{ $kbaForm->code ?? '-' }}</td>
                                <td class="text-center">{{ $kbaForm->description ?? '-' }}</td>
                                <td class="text-center">{!! getStatusYesNo($kbaForm->copy_staff_rating) !!}</td>
                                <td class="text-center">{!! getIsActiveStatus($kbaForm->is_active) !!}</td>
                                <td class="text-center">
                                    <a href="{{ route( auth()->user()->getRoles()[0].'.setups.kba.form-view', $kbaForm) }}"
                                        class="btn btn-outline-main" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="View KBA Form Details"><i
                                            class="bx bxs-show"></i></a>
                                    <a href="{{ route( auth()->user()->getRoles()[0].'.setups.kba.form-edit', $kbaForm) }}"
                                        class="btn btn-outline-secondary" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Edit KBA Form Details"><i
                                            class="bx bxs-pencil"></i></a>
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

@endsection
