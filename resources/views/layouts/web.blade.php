<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
        rel="stylesheet">
    <title>Laravel Blog @yield('title')</title>
    <link href="{{ asset('web/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('web/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/templatemo-stand-blog.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/owl.css') }}">
    @yield('styles')
</head>

<body>

    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    @include('web.partials.navbar')
    @yield('content')
    @include('web.partials.footer')
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('web/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('web/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Additional Scripts -->
    <script src="{{ asset('web/assets/js/custom.js') }}"></script>
    <script src="{{ asset('web/assets/js/owl.js') }}"></script>
    <script src="{{ asset('web/assets/js/slick.js') }}"></script>
    <script src="{{ asset('web/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('web/assets/js/accordions.js') }}"></script>
    @yield('scripts')

    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-top',
                showConfirmButton: false,
                timer: 3500
            });
            @if (Session::has('message'))
                var type="{{ Session::get('alert-type', 'info') }}"
                switch(type){
                case 'success':
                Toast.fire({
                icon: 'success',
                title: '{{ Session::get('message') }}'
                })
                break;
                }
            @endif
        });
    </script>

</body>

</html>
