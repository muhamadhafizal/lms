<!-- Add Staff Modal -->
<div class="modal fade modal-movement" id="modal-staff-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h1 class="modal-title fs-5">New Staff</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{  route(auth()->user()->getRoles()[0].'.appraisals.form-setups.staff-store', $appraisalSetup) }}">
            @csrf
            <div class="modal-body border-bottom text-start mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Staff <span class="text-danger">*</span></label>
                            <select id="staff_id" name="staff_id[]" 
                                class="form-control @error('staff_id') is-invalid @enderror select-tagging" placeholder="Please select"
                                multiple required>
                                @foreach ($listOfStaffs as $staff)
                                    <option value="{{ $staff->id }}">
                                        {{ $staff->user_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('staff_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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

