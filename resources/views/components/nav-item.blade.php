<li class="nav-item {{ request()->url() == $route ? 'active' : '' }}">
    <a class="nav-link" href="{{ $route }}">
        {{ $slot }}
    </a>
</li>
