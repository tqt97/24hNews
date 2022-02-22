<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-flat" data-widget="treeview" role="menu"
    data-accordion="false">
    <li class="nav-item ">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ (request()->segment(2) == 'dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Trang tổng quan
            </p>
        </a>

    </li>
    <li class="nav-item ">
        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ (request()->segment(2) == 'categories') ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Quản lý danh mục
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.posts.index') }}" class="nav-link {{ (request()->segment(2) == 'posts') ? 'active' : '' }}">
            <i class="nav-icon fa fa-book-open"></i>
            <p>
                Quản lý bài viết
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.tags.index') }}" class="nav-link {{ (request()->segment(2) == 'tags') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tags"></i>
            <p>
                Quản lý tags
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.comments.index') }}" class="nav-link {{ (request()->segment(2) == 'comments') ? 'active' : '' }}">
            <i class="nav-icon fas fa-comment-alt"></i>
            <p>
                Quản lý bình luận
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ (request()->segment(2) == 'contacts') ? 'active' : '' }}">
            <i class="nav-icon fas fa-address-book"></i>
            <p>
                Quản lý liên hệ
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ (request()->segment(2) == 'sliders') ? 'active' : '' }}">
            <i class="nav-icon fa fa-sliders-h"></i>
            <p>
                Quản lý slider
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.admins.index') }}" class="nav-link {{ (request()->segment(2) == 'admins') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
                Quản lý người dùng
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.history.index') }}" class="nav-link {{ (request()->segment(2) == 'history') ? 'active' : '' }}">
            <i class="nav-icon fas fa-history"></i>
            <p>
                Lịch sử
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.roles.index') }}" class="nav-link {{ (request()->segment(2) == 'roles') ? 'active' : '' }}">
            <i class="nav-icon fa fa-check-square"></i>
            <p>
                Quản lý vai trò
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ (request()->segment(2) == 'permissions') ? 'active' : '' }}">
            <i class="nav-icon fas fa-plus-circle"></i>
            <p>
                Thêm quyền
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.logout') }}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
                Đăng xuất
            </p>
        </a>
    </li>
</ul>
