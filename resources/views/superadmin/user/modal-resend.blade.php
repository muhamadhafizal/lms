<!-- Resend Staff Modal -->
<div class="modal fade modal-movement" id="resend-staff-modal-{{ $key }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h1 class="modal-title fs-5">Resend Email</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('superadmin.user.resend', $staff) }}" method="post">
                @csrf
                <div class="modal-body text-start border-bottom">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label"> Email </label>
                                <input type="text" class="form-control input-group" name="user_email"
                                            value="{{ old('user_email', $staff->user_email) }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center mt-3">
                    <button type="submit" class="form-control btn btn-main">Submit</button>
                </div>
            </form>
            
        </div>
    </div>
</div>