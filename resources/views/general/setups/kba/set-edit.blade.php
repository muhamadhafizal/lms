@extends('layouts.master.dashboard')

@section('content')
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <h5 class="title">Edit Set KBA</h5>
        <li class="breadcrumb-item">
            <a href="{{ route(auth()->user()->getRoles()[0] . '.setups.kba.index') }}">KBA Setups</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route(auth()->user()->getRoles()[0] . '.setups.kba.form-view', $kbaForm) }}">Details KBA Setup</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Edit Set KBA</li>
    </ol>
</nav>
<div class="card card-dashboard">
    <div class="card-body">
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{  route(auth()->user()->getRoles()[0] . '.setups.kba.set-update', $kbaForm) }}" method="POST">
            @csrf
            <div class="container py-4">
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap" id="kba-table">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No.</th>
                                <th style="width: 65%;">KBA</th>
                                <th style="width: 20%;">Weight %</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formattedKbas as $index => $kba)
                                @include('general.setups.kba.partials.kba-row-edit', ['kba' => $kba, 'level' => 0, 'index' => $index])
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td class="text-end"><strong>Total Weightage:</strong></td>
                                <td id="total-weight" class="text-center">0%</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3 gap-2">
                    <button class="btn btn-success btn-lg" type="submit">
                        <i class="bi bi-save"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@include('general.setups.kba.script-edit')
