@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb pb-0">
            <h5 class="title mb-0">KRA Setup</h5>
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
                    <a href="{{ route( auth()->user()->getRoles()[0]. '.setups.kra.add') }}" class="btn btn-main pt-2 pb-2 px-3 load-spinner">New
                        KRA Setup</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-dashboard mb-4">
        <div class="card-body">
            @if (count($kraSetups))
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Header</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Copy Staff Rating</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($kraSetups as $key => $kraSetup)
                            <tr>
                                <td>{{ $kraSetups->firstItem() + $key }}</td>
                                <td class="text-center">{{ $kraSetup->company->name ?? '-' }}</td>
                                <td class="text-center">{{ $kraSetup->header ?? '-' }}</td>
                                <td class="text-center">{{ $kraSetup->name ?? '-' }}</td>
                                <td class="text-center">{!! getIsActiveStatus($kraSetup->is_active) !!}</td>
                                <td class="text-center">{!! getStatusYesNo($kraSetup->is_copy) !!}</td>
                                <td class="text-center">
                                    <a href="{{ route( auth()->user()->getRoles()[0].'.setups.kra.edit', $kraSetup) }}"
                                        class="btn btn-outline-secondary" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Edit KRA Details"><i
                                            class="bx bxs-pencil"></i></a>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $kraSetups->links() }}
            @else
                @include('errors.no-data')
            @endif
        </div>
    </div>

@endsection
