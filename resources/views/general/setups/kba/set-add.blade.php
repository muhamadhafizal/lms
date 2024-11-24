@extends('layouts.master.dashboard')

@section('content')
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <h5 class="title">New Set KBA</h5>
        <li class="breadcrumb-item">
            <a href="{{ route(auth()->user()->getRoles()[0] . '.setups.kba.index') }}">KBA Setups</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route(auth()->user()->getRoles()[0] . '.setups.kba.form-view', $kbaForm) }}">Details KBA Setup</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">New Set KBA</li>
    </ol>
</nav>
<div class="card card-dashboard">
    <div class="card-body">
        <form action="{{  route(auth()->user()->getRoles()[0] . '.setups.kba.set-store', $kbaForm) }}" method="POST" id="kba-form">
            @csrf
            <div class="container py-4">
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap" id="kba-table">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No.</th>
                                <th style="width: 65%;">KBA</th>
                                <th style="width: 20%;">Weight %</th>
                                <th style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamic rows will be added here -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-end"><strong>Total Weightage:</strong></td>
                                <td id="total-weight" class="text-center">0%</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3 gap-2">
                    <button class="btn btn-primary btn-lg" type="button" id="add-row">
                        <i class="bi bi-plus-circle"></i> Add KBA
                    </button>
                    <button class="btn btn-success btn-lg" type="submit" id="save-btn">
                        <i class="bi bi-save"></i> Save
                    </button>
                </div>
                <div id="error-message" class="text-danger mt-3" style="display: none;">
                    Total weightage must equal 100%.
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@include('general.setups.kba.script')
