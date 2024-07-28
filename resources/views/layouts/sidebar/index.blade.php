<div class="sidebar-header">
    {{-- <img src="{{ app_asset('images/logo.png') }}" loading="lazy" class="img-fluid" alt="Logo"> --}}
</div>

<ul class="list-unstyled components" id="sidebar-list">
    @include('layouts.sidebar.superadmin')
   {{-- @if (checkRole('admin'))
        @include('layouts.sidebar.admin')
    @endif

    @if (checkRole('landlord'))
        @include('layouts.sidebar.landlord')
    @endif

    @if (checkRole('admin-maintenance'))
        @include('layouts.sidebar.admin-maintenance')
    @endif

    @if (checkRole('technician'))
        @include('layouts.sidebar.technician')
    @endif

    @if (checkRole('user'))
        @include('layouts.sidebar.user')
    @endif
    --}} 
</ul>
