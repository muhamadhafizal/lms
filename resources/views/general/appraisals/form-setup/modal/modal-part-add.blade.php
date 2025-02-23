<!-- Add Staff Modal -->
<div class="modal fade modal-movement" id="modal-part-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h1 class="modal-title fs-5">New Part Appraisals</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{  route(auth()->user()->getRoles()[0].'.appraisals.form-setups.part-store', $appraisalSetup) }}">
            @csrf
            <div class="modal-body border-bottom text-start mb-3">
                <div class="row">
                    <div class="col-md-12">
                         <div class="mb-3">
                            <label class="form-label"> Part <top class="text-danger">*</top></label>
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
                                @php
                                    $isExtraSelected = (request('part_id') == 'extra|0') ? 'selected' : '';
                                @endphp
                                <option value="extra|0" {{ $isExtraSelected }}>Extra Contribution</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Title <top class="text-danger">*</top> </label>
                            <input type="text" class="form-control" name="title" value="{{ request('title') }}" placeholder="Title" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Weightage %<top class="text-danger">*</top> </label>
                            <input type="number" class="form-control" name="weightage" value="{{ request('weightage') }}" placeholder="Title" required>
                        </div>
                    </div>
                </div>       
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
    </div>
</div>