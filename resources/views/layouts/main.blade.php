<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/main.css') }}">
    <!--===============================================================================================-->

</head>
<body class="animsition">

<!-- Header -->
<header>
    <!-- Header desktop -->
    <div class="wrap-menu-header gradient1 trans-0-4">
        <div class="container h-full">
            <div class="wrap_header trans-0-3">
                <!-- Logo -->
                <div class="logo">
                    <a href="index.html">
                        <img src="{{ asset('icon/logo2.png') }}" alt="IMG-LOGO" data-logofixed="{{ asset('icon/logo.png') }}">
                    </a>
                </div>

                <!-- Menu -->
                <div class="wrap_menu p-l-45 p-l-0-xl">
                    <nav class="menu">
                        <ul class="main_menu">
                            <li>
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>

                            <li>
                                <a href="menu.html">Menu</a>
                            </li>

                            <li>
                                <a href="reservation.html">Reservation</a>
                            </li>

                            <li>
                                <a href="gallery.html">Gallery</a>
                            </li>

                            <li>
                                <a href="about.html">About</a>
                            </li>

                            <li>
                                <a href="blog.html">Blog</a>
                            </li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit" class="txt19 m-m-b">Logout</button>
                                </form>
                            </li>

                        </ul>
                    </nav>
                </div>

                <!-- Social -->
                <div class="social flex-w flex-l-m p-r-20">
                    <a href="#"><i class="fa fa-tripadvisor" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-facebook m-l-21" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-twitter m-l-21" aria-hidden="true"></i></a>

                    <button class="btn-show-sidebar m-l-33 trans-0-4"></button>
                </div>
            </div>
        </div>
    </div>
</header>

@yield('sidebar')



<!-- Title Page -->
@yield('content')


<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('dashboard/js/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('dashboard/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('dashboard/js/select2.min.js') }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('dashboard/js/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('dashboard/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>
</html>
