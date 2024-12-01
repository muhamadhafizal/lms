<li class="">
    <a class="load-spinner" href="{{ route('hradmin.index') }}">
        <div class="sidebar-icon">
            <i class="bx bxs-dashboard"></i>
        </div>
        Dashboard
    </a>
</li>
<div class="seperator">Main</div>
    <li class="{{ active_check('hradmin/employee', true) }}">
        <a class="load-spinner" href="{{ route('hradmin.employee.index') }}">
            <div class="sidebar-icon">
                <i class='bx bx-group'></i>
            </div>
            Employees
        </a>
    </li>

    <div class="seperator"></div>
    <li
        class="dropdown-toggle {{ active_check('hradmin/appraisals', true) }}">
        <a href="#appraisal" data-bs-toggle="collapse" aria-expanded="false" class="mb-0">
            <div class="sidebar-icon">
                <i class='bx bx-task'></i>
            </div>
            Appraisals <i
                class="bx bx-chevron-down {{ active_route('hradmin.appraisals.*') == 'active' ? 'down' : '' }}"></i>
        </a>
        <ul class="collapse list-unstyled {{ active_route('hradmin.appraisals.*') == 'active' ? 'show' : '' }}"
            id="appraisal">
            <li class="{{ active_check('hradmin/appraisals', true) }}">
                <a class="load-spinner" href="{{ route('hradmin.appraisals.form-setups.index') }}">
                    Form Setups
                </a>
            </li>
        </ul>
    </li>

<div class="seperator">Settings</div>
    <li
        class="dropdown-toggle {{ active_check('hradmin/setups', true) }}">
        <a href="#setup" data-bs-toggle="collapse" aria-expanded="false" class="mb-0">
            <div class="sidebar-icon">
                <i class='bx bx-cog'></i>
            </div>
            Setups <i
                class="bx bx-chevron-down {{ active_route('hradmin.setups.*') == 'active' ? 'down' : '' }}"></i>
        </a>
        <ul class="collapse list-unstyled {{ active_route('hradmin.setups.*') == 'active' ? 'show' : '' }}"
            id="setup">
            <li class="{{ active_check('hradmin/setups/batch', true) }}">
                <a class="load-spinner" href="{{ route('hradmin.setups.batch.index') }}">
                    Batch
                </a>
            </li>
            <li class="{{ active_check('hradmin/setups/kra', true) }}">
                <a class="load-spinner" href="{{ route('hradmin.setups.kra.index') }}">
                    KRA
                </a>
            </li>
            <li class="{{ active_check('hradmin/setups/kba', true) }}">
                <a class="load-spinner" href="{{ route('hradmin.setups.kba.index') }}">
                    KBA
                </a>
            </li>
            <li class="{{ active_check('hradmin/setups/employee-feedback', true) }}">
                <a class="load-spinner" href="{{ route('hradmin.setups.employee-feedback.index') }}">
                    Employee Feedback
                </a>
            </li>
            <li class="{{ active_check('hradmin/setups/supervisor-feedback', true) }}">
                <a class="load-spinner" href="{{ route('hradmin.setups.supervisor-feedback.index') }}">
                    Supervisor Feedback
                </a>
            </li>
        </ul>
    </li>
  
<div class="seperator">Log</div>
    <li class="">
        <a class="load-spinner" href="{{ route('hradmin.activity-log.index') }}">
            <div class="sidebar-icon">
             <i class='bx bxs-user-detail'></i>
            </div>
            User Activity
        </a>
    </li>
