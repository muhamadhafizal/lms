@extends('layouts.master.dashboard')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <h5 class="title">Copy Set KBA</h5>
            <li class="breadcrumb-item">
                <a href="{{ route(auth()->user()->getRoles()[0] . '.setups.kba.index') }}">KBA Setups</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route(auth()->user()->getRoles()[0] . '.setups.kba.form-view', $kbaForm) }}">Details KBA Setup</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Copy Set KBA</li>
        </ol>
    </nav>
    <div class="card card-dashboard">
        <div class="card-body">
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="form-label">KBA SET</label>
                            <select class="form-select" name="copy_kba_id" id="">
                                <option value="">Please select</option>
                                @foreach($listCopyKbaForms as $listCopyKbaForm)
                                <option value="{{ $listCopyKbaForm->id }}" 
                                    {{ (old('copy_kba_id', $copyKbaId ?? '') == $listCopyKbaForm->id) ? 'selected' : '' }}>
                                    {{ $listCopyKbaForm->code }} - {{ $listCopyKbaForm->description }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-main btn-lg">Search</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card card-dashboard">
                <div class="card-body">
                    <form action="{{  route(auth()->user()->getRoles()[0].'.setups.kba.set-copy-store', $kbaForm) }}" method="post">
                        @csrf
                        <div class="row align-items-center mb-4">
                            @if ($formattedKbas)
                                <table class="table table-striped text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Weightage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($formattedKbas as $kba)
                                            @include('general.setups.kba.partials.kba-row', ['kba' => $kba, 'level' => 0, 'i' => $i++])
                                        @endforeach
                                        <tr>
                                            <td style="padding-bottom: 25px; padding-top: 25px;"></td>
                                            <td class="text-end" style="padding-bottom: 25px; padding-top: 25px;">
                                            <strong>Total Weightage:</strong>
                                            </td>
                                            <td class="text-center" style="padding-bottom: 25px; padding-top: 25px;">
                                                {{ $totalWeightage }}%
                                            </td>
                                        </tr>
                                    
                                    </tbody>
                                </table>
                                <input type="text" name="copy_kba_id" value="{{ $copyKbaId }}" hidden>
                                <div class="row justify-content-center mt-5 mb-3">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-main btn-lg w-100">Save</button>
                                    </div>
                                </div>  
                            @else
                                @include('errors.no-data')
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection