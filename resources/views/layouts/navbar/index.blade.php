<nav class="navbar navbar-dashboard fixed-top navbar-expand-xl">
    <div class="container-fluid">
        <button class="navbar-toggler collapsed" type="button" id="sidebarCollapse">
            <span class="icon-bar top-bar"></span>
            <span class="icon-bar middle-bar"></span>
            <span class="icon-bar bottom-bar"></span>
        </button>

        <a class="navbar-brand load-spinner" href="">
            <img src="{{ app_asset('images/centralhrthree.png') }}" class="img-fluid" alt="Logo">
        </a>

        <ul class="list-unstyled justify-content-end navbar-right">
          
            <li class="nav-item">
                <a class="nav-link nav-user" href="javascript:void(0);" data-bs-toggle="modal"
                    data-bs-target="#userModal">
                    <div class="img-container">
                      
                    </div>

                    <div>
                        <span class="name text-capitalize">
                            {{ getShortName(auth()->user()->user_name) }}
                        </span><br>
                            {!! getRoleBadge(auth()->user()->getRoles()[0])!!}
                    </div>
                </a>
            </li>
        </ul>
    </div>
</nav>

@include ('layouts.navbar.modal')
