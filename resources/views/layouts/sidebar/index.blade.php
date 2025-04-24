<div class="sidebar-header">
    {{-- <img src="{{ app_asset('images/logo.png') }}" loading="lazy" class="img-fluid" alt="Logo"> --}}
</div>

<ul class="list-unstyled components" id="sidebar-list">
   @if (checkRole('member'))
        @include('layouts.sidebar.member')
    @endif
</ul>
