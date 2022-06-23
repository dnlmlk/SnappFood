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
                        <img src="{{ asset('icon/logo.png') }}" alt="IMG-LOGO" data-logofixed="images/icons/logo2.png">
                    </a>
                </div>

                <!-- Menu -->
                <div class="wrap_menu p-l-45 p-l-0-xl">
                    <nav class="menu">
                        <ul class="main_menu">
                            <li>
                                <a href="index.html">Home</a>
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

<!-- Sidebar -->
<aside class="sidebar trans-0-4">
    <!-- Button Hide sidebar -->
    <button class="btn-hide-sidebar ti-close color0-hov trans-0-4"></button>

    <!-- - -->
    <ul class="menu-sidebar p-t-95 p-b-70">
        <li class="t-center m-b-13">
            <a href="index.html" class="txt19">Home</a>
        </li>

        <li class="t-center m-b-13">
            <a href="menu.html" class="txt19">Menu</a>
        </li>

        <li class="t-center m-b-13">
            <a href="gallery.html" class="txt19">Gallery</a>
        </li>

        <li class="t-center m-b-13">
            <a href="about.html" class="txt19">About</a>
        </li>

        <li class="t-center m-b-13">
            <a href="blog.html" class="txt19">Blog</a>
        </li>

        <li class="t-center m-b-33">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="txt19">Logout</button>
            </form>
        </li>

        <li class="t-center">
            <!-- Button3 -->
            <a href="reservation.html" class="btn3 flex-c-m size13 txt11 trans-0-4 m-l-r-auto">
                Reservation
            </a>
        </li>
    </ul>
</aside>


<!-- Title Page -->
<section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url({{ asset('dashboard/img/bg-title-page-03.jpg') }});">
    <h2 class="tit6 t-center">
        Blog
    </h2>
</section>


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

</body>
</html>
