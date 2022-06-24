@extends('layouts.main')

@section('sidebar')
    <!-- Sidebar -->
    <aside class="sidebar trans-0-4">
        <!-- Button Hide sidebar -->
        <button class="btn-hide-sidebar ti-close color0-hov trans-0-4"></button>

        <!-- - -->
        <ul class="menu-sidebar p-t-95 p-b-70">

            @if(auth()->user()->role == 'admin')
            <li class="t-center m-b-13">
                <a href="{{ route('RestaurantCategories.index') }}" class="txt19">Restaurants categories</a>
            </li>

            <li class="t-center m-b-13">
                <a href="{{ route('FoodCategories.index') }}" class="txt19">Food categories</a>
            </li>

            <li class="t-center m-b-13">
                <a href="#" class="txt19">Manage discounts</a>
            </li>

            <li class="t-center m-b-13">
                <a href="#" class="txt19">Manage comments</a>
            </li>

            <li class="t-center m-b-13">
                <a href="#" class="txt19">Manage banners</a>
            </li>

            @endif

            <li class="t-center m-b-33">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="txt19">Logout</button>
                </form>
            </li>


            @if(auth()->user()->role == 'customer')

            <li class="t-center">
                <!-- Button3 -->
                <a href="reservation.html" class="btn3 flex-c-m size13 txt11 trans-0-4 m-l-r-auto">
                    Reservation
                </a>
            </li>
            @endif
        </ul>
    </aside>
@endsection

@section('content')
    <!-- Title Page -->
    <section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url({{ asset('dashboard/img/bg-title-page-03.jpg') }});">
        <h2 class="txt1 t-center">
            Dashboard
        </h2>
    </section>
@endsection

