<!DOCTYPE html>
<html lang="en">
<head>
    <!--
    More Templates Visit ==> Free-Template.co
    -->
    <title>Main Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Free Template by Free-Template.co" />
    <meta name="keywords" content="free bootstrap 4, free bootstrap 4 template, free website templates, free html5, free template, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="Free-Template.co" />

    <link rel="stylesheet" href="{{ asset('main/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('main/css/style.css') }}">
</head>
<body data-spy="scroll" data-target="#ftco-navbar" data-offset="200">

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="#">Snapp Food</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="#section-home" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->

<section class="ftco-cover" style="background-image: url({{ asset('main/img/bg_3.jpg') }});" id="section-home">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center ftco-vh-100">
            <div class="col-md-12">
                <h1 class="ftco-heading ftco-animate mb-3">Welcome To Snapp Food</h1>
                <h2 class="h5 ftco-subheading mb-5 ftco-animate">We wish enjoy by this app </h2>
                <p><a href="https://free-template.co/" target="_blank" class="btn btn-outline-white btn-lg ftco-animate" data-toggle="modal" data-target="#reservationModal">Reservation</a></p>
            </div>
        </div>
    </div>
</section>
<!-- END section -->


<script src="{{ asset('main/js/jquery.min.js') }}"></script>
<script src="{{ asset('main/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('main/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('main/js/main.js') }}"></script>


</body>
</html>
