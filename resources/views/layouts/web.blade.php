<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>24 News - Application </title>
    <link href="{{ asset('web/css/media_query.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('web/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('web/css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="{{ asset('web/css/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('web/css/owl.theme.default.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('web/css/style_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- Modernizr JS -->
    <script src="{{ asset('web/js/modernizr-3.5.0.min.js') }}"></script>
</head>

<body>
    @include('web.layouts.partials.header-bg')
    @include('web.layouts.partials.menu')
    @yield('content')
    @include('web.layouts.partials.footer')
    @include('web.layouts.partials.copy-right')

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('web/js/owl.carousel.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js">    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js">    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js">    </script>
    <!-- Waypoints -->
    <script src="{{ asset('web/js/jquery.waypoints.min.js') }}"></script>
    <!-- Main -->
    <script src="{{ asset('web/js/main.js') }}"></script>

</body>

</html>
