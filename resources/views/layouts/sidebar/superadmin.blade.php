<li class="">
    <a class="load-spinner" href="{{ route('superadmin.index') }}">
        <div class="sidebar-icon">
            <i class="bx bxs-dashboard"></i>
        </div>
        Dashboard
    </a>
</li>
<div class="seperator">Main</div>
    <li>
        <a class="load-spinner" href="{{ route('superadmin.client.index') }}">
            <div class="sidebar-icon">
                <i class='bx bx-sitemap'></i>
            </div>
            Clients
        </a>
    </li>
    <li>
        <a class="load-spinner" href="{{ route('superadmin.company.index') }}">
            <div class="sidebar-icon">
                <i class='bx bx-buildings'></i>
            </div>
            Companies
        </a>
    </li>
<div class="seperator">Users</div>
    <li class="">
        <a class="load-spinner" href="{{ route('superadmin.user.index') }}">
            <div class="sidebar-icon">
                <i class="bx bx-user-check"></i>
            </div>
            Central HR Staff
        </a>
    </li>
    <li class="">
        <a class="load-spinner" href="{{ route('superadmin.employee.index') }}">
            <div class="sidebar-icon">
                <i class="bx bx-group"></i>
            </div>
            Employees
        </a>
    </li>
<div class="seperator">Log</div>
    <li class="">
        <a class="load-spinner" href="{{ route('superadmin.activity-log.index') }}">
            <div class="sidebar-icon">
             <i class='bx bxs-user-detail'></i>
            </div>
            User Activity
        </a>
    </li>
