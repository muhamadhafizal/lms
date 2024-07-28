<li class="{{ active_check('user') }}">
    <a class="load-spinner" href="{{ route('user.index') }}">
        <div class="sidebar-icon">
            <i class="bx bxs-dashboard"></i>
        </div>
        Dashboard
    </a>
</li>

<div class="seperator">Profile</div>
<li class="{{ active_check('user/profile', true) }}">
    <a class="load-spinner" href="{{ route('user.profile.index') }}">
        <div class="sidebar-icon">
            <i class='bx bx-user'></i>
        </div>
        Profile
    </a>
</li>

<div class="seperator">Log</div>

<li class="{{ active_check('user/notification', true) }}">
    <a class="load-spinner" href="{{ route('user.notification.index') }}">
        <div class="sidebar-icon">
            <i class='bx bx-bell'></i>
        </div>
        Notification
        @if (countNotification() > 0)
            <span class="badge badge-active">{{ countNotification() }}</span>
        @endif
    </a>
</li>

<li class="{{ active_check('user/activity', true) }}">
    <a class="load-spinner" href="{{ route('user.activity.index') }}">
        <div class="sidebar-icon">
            <i class='bx bxs-user-detail'></i>
        </div>
        Activity Log
    </a>
</li>

<li class="{{ active_check('user/login-activity', true) }}">
    <a class="load-spinner" href="{{ route('user.login-activity.index') }}">
        <div class="sidebar-icon">
            <i class='bx bx-log-in'></i>
        </div>
        Login Activity
    </a>
</li>
