<li class="">
    <a class="load-spinner" href="{{ route('superadmin.index') }}">
        <div class="sidebar-icon">
            <i class="bx bxs-dashboard"></i>
        </div>
        Dashboard
    </a>
</li>
<div class="seperator">Main</div>
    <li class="{{ active_check('superadmin/client', true) }}">
        <a class="load-spinner" href="{{ route('superadmin.client.index') }}">
            <div class="sidebar-icon">
                <i class='bx bx-sitemap'></i>
            </div>
            Clients
        </a>
    </li>
    <li class="{{ active_check('superadmin/company', true) }}">
        <a class="load-spinner" href="{{ route('superadmin.company.index') }}">
            <div class="sidebar-icon">
                <i class='bx bx-buildings'></i>
            </div>
            Companies
        </a>
    </li>
    <li
        class="dropdown-toggle {{ active_check('superadmin/user', true) }} {{ active_check('superadmin/employee', true) }}">
        <a href="#user" data-bs-toggle="collapse" aria-expanded="false" class="mb-0">
            <div class="sidebar-icon">
                <i class='bx bx-group'></i>
            </div>
            Users <i
                class="bx bx-chevron-down {{ active_route('superadmin.user.*') == 'active' ? 'down' : '' }} {{ active_route('superadmin.employee.*') == 'active' ? 'down' : '' }}"></i>
        </a>
        <ul class="collapse list-unstyled {{ active_route('superadmin.user.*') == 'active' ? 'show' : '' }} {{ active_route('superadmin.employee.*') == 'active' ? 'show' : '' }}"
            id="user">
            <li class="{{ active_check('superadmin/user', true) }}">
                <a class="load-spinner" href="{{ route('superadmin.user.index') }}">
                    Central HR Staff
                </a>
            </li>
            <li class="{{ active_check('superadmin/employee', true) }}">
                <a class="load-spinner" href="{{ route('superadmin.employee.index') }}">
                    Employees
                </a>
            </li>
        </ul>
    </li>


<div class="seperator">Settings</div>
    <li
        class="dropdown-toggle {{ active_check('superadmin/setups', true) }}">
        <a href="#setup" data-bs-toggle="collapse" aria-expanded="false" class="mb-0">
            <div class="sidebar-icon">
                <i class='bx bx-cog'></i>
            </div>
            Setups <i
                class="bx bx-chevron-down {{ active_route('superadmin.setups.*') == 'active' ? 'down' : '' }}"></i>
        </a>
        <ul class="collapse list-unstyled {{ active_route('superadmin.setups.*') == 'active' ? 'show' : '' }}"
            id="setup">
            <li class="{{ active_check('superadmin/setups/batch', true) }}">
                <a class="load-spinner" href="{{ route('superadmin.setups.batch.index') }}">
                    Batch
                </a>
            </li>
            <li class="{{ active_check('superadmin/setups/kra', true) }}">
                <a class="load-spinner" href="{{ route('superadmin.setups.kra.index') }}">
                    KRA
                </a>
            </li>
            <li class="{{ active_check('superadmin/setups/kba', true) }}">
                <a class="load-spinner" href="{{ route('superadmin.setups.kba.index') }}">
                    KBA
                </a>
            </li>
            <li class="{{ active_check('superadmin/setups/employee-feedback', true) }}">
                <a class="load-spinner" href="{{ route('superadmin.setups.employee-feedback.index') }}">
                    Employee Feedback
                </a>
            </li>
            <li class="{{ active_check('superadmin/setups/supervisor-feedback', true) }}">
                <a class="load-spinner" href="{{ route('superadmin.setups.supervisor-feedback.index') }}">
                    Supervisor Feedback
                </a>
            </li>
        </ul>
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
