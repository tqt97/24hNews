<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="rating" content="adult" />
    <meta http-equiv="Content-Type" content="" charset="" />
    <meta name="description" content="Hệ thống quản trị website">
    <meta name="keywords" content="Laravel, blog, tin tức, quản trị hệ thống">
    <meta name="author" content="tqt97">
    <title>@stack('title') - Quản trị hệ thống </title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">

    @stack('styles')
    <style>
        #datatable_filter {
            display: none;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-footer-fixed layout-fixed">
    <div class="wrapper">
        @include('admin.partials.navbar')
        @include('admin.partials.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        {{-- @include('admin.partials.footer') --}}
        <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $.extend(true, $.fn.dataTable.defaults, {
            // "language": {
            //     "url": "https://cdn.datatables.net/plug-ins/1.11.4/i18n/vi.json"
            // },
            "processing": true,
            "serverSide": true,
        });
    </script>
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
    @stack('scripts')
</body>

</html>
