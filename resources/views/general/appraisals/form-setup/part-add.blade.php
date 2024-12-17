@extends('layouts.master.dashboard')

@section('content')
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <h5 class="title">New Part Appraisals</h5>
        <li class="breadcrumb-item"><a href="{{ route( auth()->user()->getRoles()[0]. '.appraisals.form-setups.index') }}">Form Setups</a></li>
        <li class="breadcrumb-item">
            <a href="{{ route(auth()->user()->getRoles()[0] . '.appraisals.form-setups.view', $appraisalSetup) }}">Details Form Setup</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">New Part Appraisals</li>
    </ol>
</nav>
<div class="card card-dashboard">
    <div class="card-body">
        <form action="" method="get">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name" class="form-label">Part</label>
                        <select class="form-select" name="part_id" id="">
                            <option value="">Please select</option>
                            @foreach($listOfParts as $group => $parts)
                                <optgroup label="{{ $group }}">
                                    @foreach($parts as $part)
                                        @php
                                            $optionValue = $group . '|' . $part['id'];
                                            $isSelected = (request('part_id') == $optionValue) ? 'selected' : '';
                                        @endphp
                                        <option value="{{ $optionValue }}" {{ $isSelected }}>
                                            @if($group === 'KBA')
                                                {{ $part['code'] }}
                                            @else
                                                {{ $part['name'] }}
                                            @endif
                                        </option>
                                    @endforeach
                                </optgroup>
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
                @if($request->part_id)
                DATA
                @else
                    @include('errors.no-data')
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@include('general.setups.kba.script')
