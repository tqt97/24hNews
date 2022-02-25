<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <h2>Laravel<em>log</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <x-nav-item>
                        <x-slot name="route"> {{ url('/') }} </x-slot>
                        {{ __('Home') }}
                    </x-nav-item>
                    <x-nav-item>
                        <x-slot name="route"> {{ url('/about-us') }} </x-slot>
                        Về chúng tôi
                    </x-nav-item>
                    <x-nav-item>
                        <x-slot name="route"> {{ url('/posts') }} </x-slot>
                        Bài viết
                    </x-nav-item>
                    <x-nav-item>
                        <x-slot name="route"> {{ url('/categories') }} </x-slot>
                        Danh mục
                    </x-nav-item>
                    <x-nav-item>
                        <x-slot name="route"> {{ url('/contacts') }} </x-slot>
                        Liên hệ
                    </x-nav-item>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            Language
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('admin.change.language', 'vi') }}" class="dropdown-item">
                                {{ __('Vietnamese') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.change.language', 'en') }}" class="dropdown-item">
                                {{ __('English') }}
                            </a>
                        </div>
                    </li>
                    @foreach (LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                        <li>
                            <a href="{{ LaravelLocalization::localizeURL(Request::path(), $localeCode) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                             document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-in"></i>
                                {{ Auth::user()->name }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">
                                <i class="fa fa-sign-in"></i>
                                Đăng nhập
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
