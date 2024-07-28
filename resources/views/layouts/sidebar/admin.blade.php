<li class="{{ active_check('admin') }}">
    <a class="load-spinner" href="{{ route('admin.index') }}">
        <div class="sidebar-icon">
            <i class="bx bxs-dashboard"></i>
        </div>
        Dashboard
    </a>
</li>

<div class="seperator">Main</div>
<li class="{{ active_check('admin/airline', true) }}">
    <a class="load-spinner" href="{{ route('admin.airline.index') }}">
        <div class="sidebar-icon">
            <i class='bx bx-buildings'></i>
        </div>
        Airlines
    </a>
</li>

<li class="dropdown-toggle {{ active_check('admin/aircraft', true) }} {{ active_check('admin/aircraft-type', true) }}">
    <a href="#setting" data-bs-toggle="collapse" aria-expanded="false" class="mb-0">
        <div class="sidebar-icon">
            <i class='bx bxs-plane'></i>
        </div>
        Aircrafts <i
            class="bx bx-chevron-down {{ active_route('admin.aircraft.*') == 'active' ? 'down' : '' }} {{ active_route('admin.aircraft-type.*') == 'active' ? 'down' : '' }}"></i>
    </a>
    <ul class="collapse list-unstyled {{ active_route('admin.aircraft.*') == 'active' ? 'show' : '' }} {{ active_route('admin.aircraft-type.*') == 'active' ? 'show' : '' }}"
        id="setting">
        <li class="{{ active_check('admin/aircraft', true) }}">
            <a class="load-spinner" href="{{ route('admin.aircraft.index') }}">
                All Aircrafts
            </a>
        </li>
        <li class="{{ active_check('admin/aircraft-type', true) }}">
            <a class="load-spinner" href="{{ route('admin.aircraft-type.index') }}">
                Model Types
            </a>
        </li>
    </ul>
</li>

<div class="seperator">User</div>
@if (auth()->user()->type == 'Superadmin' || auth()->user()->type == 'Admin')
    <li class="{{ active_check('admin/staff', true) }}">
        <a class="load-spinner" href="{{ route('admin.staff.index') }}">
            <div class="sidebar-icon">
                <i class="bx bx-user-check"></i>
            </div>
            Staff
        </a>
    </li>
@endif

<div class="seperator">Log</div>
<li class="{{ active_check('admin/notification', true) }}">
    <a class="load-spinner" href="{{ route('admin.notification.index') }}">
        <div class="sidebar-icon">
            <i class='bx bx-bell'></i>
        </div>
        Notification
        @if (countNotification() > 0)
            <span class="badge badge-active">{{ countNotification() }}</span>
        @endif
    </a>
</li>

<li class="{{ active_check('admin/activity', true) }}">
    <a class="load-spinner" href="{{ route('admin.activity.index') }}">
        <div class="sidebar-icon">
            <i class='bx bxs-user-detail'></i>
        </div>
        Activity Log
    </a>
</li>

<li class="{{ active_check('admin/login-activity', true) }}">
    <a class="load-spinner" href="{{ route('admin.login-activity.index') }}">
        <div class="sidebar-icon">
            <i class='bx bx-log-in'></i>
        </div>
        Login Activity
    </a>
</li>
