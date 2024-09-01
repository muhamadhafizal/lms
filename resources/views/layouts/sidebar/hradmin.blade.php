<li class="">
    <a class="load-spinner" href="">
        <div class="sidebar-icon">
            <i class="bx bxs-dashboard"></i>
        </div>
        Dashboard
    </a>
</li>
<div class="seperator">Users</div>
    <li class="">
        <a class="load-spinner" href="{{ route('hradmin.employee.index') }}">
            <div class="sidebar-icon">
                <i class="bx bx-group"></i>
            </div>
            Employees
        </a>
    </li>
<div class="seperator">Log</div>
    <li class="">
        <a class="load-spinner" href="{{ route('hradmin.activity-log.index') }}">
            <div class="sidebar-icon">
             <i class='bx bxs-user-detail'></i>
            </div>
            Activity Log
        </a>
    </li>