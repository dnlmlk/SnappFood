<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('food/images/favicon.png') }}" type="">

    <title> Edit Food </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('food/css/bootstrap.css') }}" />

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="{{ asset('food/css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('food/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('food/css/responsive.css') }}" rel="stylesheet" />

</head>

<body class="sub_page">

<div class="hero_area">
    <div class="bg-box">
        <img src="{{ asset('food/images/hero-bg.jpg') }}" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="{{ route('ManageFood.index') }}">
                    <span>
                        SnappFood
                    </span>
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav  mx-auto ">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ManageFood.index') }}">Menu <span class="sr-only">(current)</span> </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('ManageFood.create') }}">Add Food</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- end header section -->
</div>


<!-- book section -->
<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Edit Food
            </h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form_container">
                    <form action="{{ route('ManageFood.update', $id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div>
                            <input type="text" name="name" value="{{ old('name') ?? $food->name}}" class="form-control" placeholder="Food Name" />
                        </div>
                        <div>
                            <input type="number" name="price" value="{{ old('price') ?? $food->price}}" class="form-control" placeholder="Price" />
                        </div>
                        <div>
                            <input type="text" name="raw_material" value="{{ old('material') ?? $food->raw_material}}" class="form-control" placeholder="Raw Materials" />
                        </div>
                        <div>
                            <select class="form-control nice-select wide" name="food_categories_id">
                                <option value="" disabled selected>
                                    Food Category
                                </option>
                                @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" @if($id == $food->food_categories_id) {{ 'selected' }} @endif>
                                    {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select class="form-control nice-select wide" name="discount_id">
                                <option value="" disabled selected>
                                    Discount
                                </option>
                                @foreach($discounts as $id => $discount)

                                    <option value="{{ $discount->id }}" @if($discount->id == $food->discount_id) {{ 'selected' }} @endif>
                                    {{ $discount->value . "%" }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="file" name="imagePath" id="img" class="form-control w-50 d-inline mr-5">
                            <img src="{{ asset($food->image_path) }}" class="img-fluid w-25" alt="Default image">
                        </div>

                        @if($errors->all())
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->all()[0] }}
                            </div>

                        @endif


                        <div class="btn_box">
                            <button type="submit" id="submit">
                                Edit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="img-box text-center">
                    <img src="{{ asset('food/images/o2.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end book section -->

<!-- footer section -->
<footer class="footer_section">
    <div class="container">

        <div class="footer-info">
            <p>
                &copy; <span id="displayYear"></span> All Rights Reserved By
                <a href="https://html.design/">Free Html Templates</a><br><br>
                &copy; <span id="displayYear"></span> Distributed By
                <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
            </p>
        </div>
    </div>
</footer>
<!-- footer section -->

<!-- jQery -->
<script src="{{ asset('food/js/jquery-3.4.1.min.js') }}"></script>
<!-- popper js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<!-- bootstrap js -->
<script src="{{ asset('food/js/bootstrap.js') }}"></script>
<!-- owl slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<!-- isotope js -->
<script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
<!-- nice select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
<!-- custom js -->
<script src="{{ asset('food/js/custom.js') }}"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
</script>
<!-- End Google Map -->

</body>

</html>
