<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="l" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ __('Administrator System') }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->admin_image }}" class="img-circle elevation-2">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ auth()->user()->name }}
                </a>
            </div>
        </div>

        <nav class="mt-2">
            @include('admin.partials.menu')
        </nav>
    </div>
</aside>
