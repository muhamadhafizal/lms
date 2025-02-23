<li class="">
    <a class="load-spinner" href="">
        <div class="sidebar-icon">
            <i class="bx bxs-dashboard"></i>
        </div>
        Dashboard
    </a>
</li>

<div class="seperator"></div>
    <li
        class="dropdown-toggle {{ active_check('employee/appraisals', true) }}">
        <a href="#appraisal" data-bs-toggle="collapse" aria-expanded="false" class="mb-0">
            <div class="sidebar-icon">
                <i class='bx bx-task'></i>
            </div>
            Appraisals <i
                class="bx bx-chevron-down {{ active_route('employee.appraisals.*') == 'active' ? 'down' : '' }}"></i>
        </a>
        <ul class="collapse list-unstyled {{ active_route('employee.appraisals.*') == 'active' ? 'show' : '' }}"
            id="appraisal">
            <li class="{{ active_check('employee/appraisals', true) }}">
                <a class="load-spinner" href="{{  route('employee.appraisals.index') }}">
                    Form
                </a>
            </li>
        </ul>
    </li>

<div class="seperator">Log</div>
    <li class="">
        <a class="load-spinner" href="{{ route('employee.activity-log.index') }}">
            <div class="sidebar-icon">
             <i class='bx bxs-user-detail'></i>
            </div>
            Activity Log
        </a>
    </li>