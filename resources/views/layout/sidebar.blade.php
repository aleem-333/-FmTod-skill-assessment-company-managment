<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
    <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
    <span class="ms-1 font-weight-bold">Test App</span>
    </a>
</div>
<hr class="horizontal dark mt-0">
<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ (request()->is('/') == 1) ? 'active' : ''  }}" href="{{url('/')}}">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ (request()->is('companies') == 1) ? 'active' : ''  }}" href="{{ url('companies')}}">
            <i class="fa fa-users"></i>
            <span class="nav-link-text ms-1">Companies</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ (request()->is('employees') == 1) ? 'active' : ''  }}" href="{{ url('employees')}}">
            <i class="fa fa-users"></i>
            <span class="nav-link-text ms-1">Employees</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ (request()->is('profile') == 1) ? 'active' : ''  }}" href="{{ url('profile')}}">
            <i class="fa fa-user"></i>
            <span class="nav-link-text ms-1">Profile</span>
        </a>
    </li>
    
    </ul>
</div>