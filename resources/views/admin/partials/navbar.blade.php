<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <i class="fa fa-share"></i>  {{ __('Home page') }}
            </a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-globe-asia"></i>
                <i class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.change.language','vi') }}" class="dropdown-item">
                   {{ __('Vietnamese') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.change.language','en') }}" class="dropdown-item">
                    {{ __('English') }}
                </a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{ auth()->user()->name }}
                <i class="fas fa-user-circle"></i>
                <i class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.profiles.edit', auth()->user()->id) }}" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i>  {{ __('Profile') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-cogs mr-2"></i>  {{ __('Setting') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i>  {{ __('Logout') }}
                </a>
                <div class="dropdown-divider"></div>

            </div>
        </li>
    </ul>
</nav>
