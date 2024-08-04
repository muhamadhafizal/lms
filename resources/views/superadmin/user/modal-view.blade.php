<!-- Details Staff Modal -->
<div class="modal fade modal-movement" id="view-staff-modal-{{ $key }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h1 class="modal-title fs-5">Staff Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start border-bottom mb-3">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <tr>
                            <td>Name</td>
                            <td><b class="text-main">{{ $staff->user_name ?? '-' }}</b></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><b class="text-main">{{ $staff->user_email ?? '-' }}</b></td>
                        </tr>
                        <tr>
                            <td>Language</td>
                            <td><b class="text-main">{{ $staff->user_language ?? '-' }}</b></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><b class="text-main">{!! getIsActiveStatus($staff->user_status) !!}</b></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-main" data-bs-dismiss="modal"
                aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>