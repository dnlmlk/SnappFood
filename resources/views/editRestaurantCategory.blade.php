@extends('layouts.main')

@section('sidebar')
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
                    <a href="{{ route('Discount.index') }}" class="txt19">Manage discounts</a>
                </li>

                <li class="t-center m-b-13">
                    <a href="{{ route('comments.admin') }}" class="txt19">Manage comments</a>
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
    <section class="section-booking bg1-pattern p-t-120 p-b-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-b-30">
                    <div class="t-center">
						<span class="tit2 t-center">
							Restaurants Categories
						</span>

                        <h3 class="tit3 t-center m-b-35 m-t-2">
                            Edit
                        </h3>
                    </div>

                    <form class="wrap-form-booking" method="post" action="{{ route('RestaurantCategories.update', $id) }}">
                        @method('put')
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <!-- Date -->
                                <span class="txt9">
									Category name
								</span>

                                <div class="wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                                    <input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="editedName" value="{{ $name }}">
                                </div>


                            </div>
                        </div>

                        <div class="wrap-btn-booking flex-c-m m-t-6">
                            <!-- Button3 -->
                            <button type="submit" class="btn3 flex-c-m size13 txt11 trans-0-4">
                                Edit
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6 p-b-30 p-t-18">
                    <div class="wrap-pic-booking size2 bo-rad-10 hov-img-zoom m-l-r-auto">
                        <img src="{{ asset('rCategories/img/booking-01.jpg') }}" alt="IMG-OUR">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


