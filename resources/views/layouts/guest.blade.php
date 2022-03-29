<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Šaleški študentski klub</title>
    <link rel="icon" type="image/png" href="/images/logos/icon.png" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- CUSTOM JS -->
    <script src="{{ asset('js/admin/sidebar.js') }}" defer></script>
    <script src="{{ asset('js/admin/alert.js') }}" defer></script>
    <script src="{{ asset('js/admin/topTop.js') }}" defer></script>

    @yield('js')

    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1d264cf014.js" crossorigin="anonymous"></script>

    <!-- ajax and shit -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>



<body id="body" style="background-color:black;">

    <link rel="stylesheet" href="https://cdn.lineicons.com/2.0/LineIcons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Vadodara:wght@300;500&display=swap" rel="stylesheet">

    <div class="container" style="width: 100%;">

        <nav class="navbar navbar-dark bg-dark public-navbar" style="background-color:black !important;">
            <!-- Navbar content -->
            <div class="nav-container">
                <img src="/images/logos/logo.png" class="public-logo" width="50%">
            </div>
        </nav>

        <div class="main">
            <div class="page-content"
                style="background-color:black;padding-top: 5rem;display:flex;flex-direction:column;">
                @yield("content")
            </div>
        </div>
    </div>

</body>

</html>
