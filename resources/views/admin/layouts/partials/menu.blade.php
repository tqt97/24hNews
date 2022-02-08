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
        <a href="{{ route('admin.category.index') }}" class="nav-link {{ (request()->segment(2) == 'category') ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Quản lý danh mục
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.post.index') }}" class="nav-link {{ (request()->segment(2) == 'post') ? 'active' : '' }}">
            <i class="nav-icon fa fa-book-open"></i>
            <p>
                Quản lý bài viết
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>
            <p>
                Quản lý tags
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-comment-alt"></i>
            <p>
                Quản lý bình luận
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-address-book"></i>
            <p>
                Quản lý liên hệ
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-alt"></i>
            <p>
                Quản lý người dùng
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
