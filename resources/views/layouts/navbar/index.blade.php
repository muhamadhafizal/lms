<nav class="navbar navbar-dashboard fixed-top navbar-expand-xl">
    <div class="container-fluid">
        <button class="navbar-toggler collapsed" type="button" id="sidebarCollapse">
            <span class="icon-bar top-bar"></span>
            <span class="icon-bar middle-bar"></span>
            <span class="icon-bar bottom-bar"></span>
        </button>

        <a class="navbar-brand load-spinner" href="">
            <img src="" class="img-fluid" alt="Logo">
        </a>

        <ul class="list-unstyled justify-content-end navbar-right">
          
            <li class="nav-item dropdown">
            <a class="nav-link nav-user" href="javascript:void(0);" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
                    <div>
                        <span class="name text-capitalize">
                            {{ getShortName(auth()->user()->user_name) }}
                        </span><br>
                            {!! getRoleBadge(auth()->user()->getRoles()[0])!!}
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item load-spinner" role="button" href="">View Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item load-spinner" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

@include ('layouts.navbar.modal')
