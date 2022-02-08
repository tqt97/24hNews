<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.layouts.partials.navbar')
        @include('admin.layouts.partials.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('admin.layouts.partials.footer')
    </div>
    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            @if (Session::has('message'))
                var type="{{ Session::get('alert-type', 'info') }}"
                switch(type){

                case 'info':
                Toast.fire({
                icon: 'info',
                title: '{{ Session::get('message') }}'
                })
                break;

                case 'success':
                Toast.fire({
                icon: 'success',
                title: '{{ Session::get('message') }}'
                })
                break;

                case 'warning':
                Toast.fire({
                icon: 'warning',
                title: '{{ Session::get('message') }}'
                })
                break;
                case 'error':
                Toast.fire({
                icon: 'error',
                title: '{{ Session::get('message') }}'
                })
                break;
                case 'question':
                Toast.fire({
                icon: 'question',
                title: '{{ Session::get('message') }}'
                })
                break;
                }
            @endif
        });
    </script>
    @yield('scripts')
</body>

</html>
