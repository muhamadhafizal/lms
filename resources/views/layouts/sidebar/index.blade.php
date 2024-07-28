<div class="sidebar-header">
    {{-- <img src="{{ app_asset('images/logo.png') }}" loading="lazy" class="img-fluid" alt="Logo"> --}}
</div>

<ul class="list-unstyled components" id="sidebar-list">
   @if (checkRole('superadmin'))
        @include('layouts.sidebar.superadmin')
    @endif

    @if (checkRole('hradmin'))
        @include('layouts.sidebar.hradmin')
    @endif

    @if (checkRole('supervisor'))
        @include('layouts.sidebar.supervisor')
    @endif

    @if (checkRole('employee'))
        @include('layouts.sidebar.employee')
    @endif
</ul>
