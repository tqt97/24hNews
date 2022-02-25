<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-flat" data-widget="treeview" role="menu"
    data-accordion="false">
    <li class="nav-item ">
        <a href="{{ route('admin.dashboard') }}"
            class="nav-link {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                {{ __('Dashboard') }}
            </p>
        </a>

    </li>
    <li class="nav-item ">
        <a href="{{ route('admin.categories.index') }}"
            class="nav-link {{ request()->segment(2) == 'categories' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
                {{ __('Category management') }}

            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.posts.index') }}"
            class="nav-link {{ request()->segment(2) == 'posts' ? 'active' : '' }}">
            <i class="nav-icon fa fa-book-dead"></i>
            <p>
                {{ __('Post management') }}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.tags.index') }}"
            class="nav-link {{ request()->segment(2) == 'tags' ? 'active' : '' }}">
            <i class="nav-icon fas fa-tags"></i>
            <p>
                {{ __('Tag management') }}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.comments.index') }}"
            class="nav-link {{ request()->segment(2) == 'comments' ? 'active' : '' }}">
            <i class="nav-icon fas fa-comment-alt"></i>
            <p>
                {{ __('Comment management') }}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.contacts.index') }}"
            class="nav-link {{ request()->segment(2) == 'contacts' ? 'active' : '' }}">
            <i class="nav-icon fas fa-address-book"></i>
            <p>
                {{ __('Contact management') }}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.sliders.index') }}"
            class="nav-link {{ request()->segment(2) == 'sliders' ? 'active' : '' }}">
            <i class="nav-icon fa fa-sliders-h"></i>
            <p>
                {{ __('Slider management') }}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.admins.index') }}"
            class="nav-link {{ request()->segment(2) == 'admins' ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
                {{ __('User management') }}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.history.index') }}"
            class="nav-link {{ request()->segment(2) == 'history' ? 'active' : '' }}">
            <i class="nav-icon fas fa-history"></i>
            <p>
                {{ __('History management') }}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.roles.index') }}"
            class="nav-link {{ request()->segment(2) == 'roles' ? 'active' : '' }}">
            <i class="nav-icon fa fa-check-square"></i>
            <p>
                {{ __('Role management') }}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.permissions.index') }}"
            class="nav-link {{ request()->segment(2) == 'permissions' ? 'active' : '' }}">
            <i class="nav-icon fas fa-plus-circle"></i>
            <p>
                {{ __('Permission management') }}
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.logout') }}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
                {{ __('Logout') }}
            </p>
        </a>
    </li>
</ul>
<div class="card-footer  text-white text-center" style="position: relative;">
    {{-- <div class="fixed"> --}}
    <div class="d-none d-sm-inline">
        From ❤️ Gialai
    </div>
    <br>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022 .</strong>
    <br>
    All rights reserved.
    {{-- </div> --}}

</div>
