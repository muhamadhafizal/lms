<!-- Add Staff Modal -->
<div class="modal fade modal-movement" id="add-staff-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h1 class="modal-title fs-5">Staff Register</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('superadmin.user.store') }}">
            @csrf
            <div class="modal-body border-bottom text-start mb-3">
                <div class="row">
                    <div class="col-md-6">
                         <div class="mb-3">
                            <label class="form-label"> Name <top class="text-danger">*</top></label>
                            <input type="text" class="form-control input-group @error('user_name') is-invalid @enderror" name="user_name"
                                value="{{ old('user_name') }}">

                            @error('user_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label"> Email <top class="text-danger">*</top></label>
                            <input type="text" class="form-control input-group @error('user_email') is-invalid @enderror" name="user_email"
                                value="{{ old('user_email') }}">

                            @error('user_email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>   
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Language</label>
                            <select name="user_language" class="form-select @error('user_language') is-invalid @enderror select-tagging">
                                <option value="" selected disabled>Please Select</option>
                                <option value="English" {{ old('user_language') == 'English' ? 'selected' : '' }}>English</option>
                                <option value="Malay" {{ old('user_language') == 'Malay' ? 'selected' : '' }}>Malay</option>
                                <option value="Chinese" {{ old('user_language') == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                                <option value="Tamil" {{ old('user_language') == 'Tamil' ? 'selected' : '' }}>Tamil</option>
                            </select>

                            @error('user_language')
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