@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb pb-0">
            <h5 class="title mb-0">Companies ({{ $companies->total() }})</h5>
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
                    <a href="{{ route('superadmin.company.add') }}" class="btn btn-main pt-2 pb-2 px-3 load-spinner">New
                        Company</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-dashboard mb-4">
        <div class="card-body">
            @if (count($companies))
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Client</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Staff</th>
                                <th class="text-center">Reg. Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $key => $company)
                                <tr>
                                    <td>{{ $companies->firstItem() + $key }}</td>
                                    <td class="text-center">{{ $company->client->name ?? '-' }}</td>
                                    <td class="text-center">{{ $company->name ?? '-' }}</td>
                                    <td class="text-center">{{ '-' }}</td>
                                    <td class="text-center">{{ $company->registration_date ?? '-' }}</td>
                                    <td class="text-center">{!! getIsActiveStatus($company->is_active) !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('superadmin.company.view', $company) }}"
                                            class="btn btn-outline-main" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Company Details"><i class="bx bxs-show"></i></a>
                                        <a href="{{ route('superadmin.company.edit', $company) }}"
                                            class="btn btn-outline-secondary" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="Edit Company Details"><i
                                                class="bx bxs-pencil"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $companies->links() }}
            @else
                @include('errors.no-data')
            @endif
        </div>
    </div>

@endsection
