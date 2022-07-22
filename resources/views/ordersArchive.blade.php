
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
                    <a href="{{ route('Discount.index') }}" class="txt19">Manage discounts</a>
                </li>

                <li class="t-center m-b-13">
                    <a href="#" class="txt19">Manage comments</a>
                </li>

                <li class="t-center m-b-13">
                    <a href="#" class="txt19">Manage banners</a>
                </li>

            @elseif(auth()->user()->role == 'seller')
                @php($restaurant = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first())

                <li class="t-center">
                    <form method="post" action="{{ route('Restaurant.update', $restaurant->id) }}">
                        @csrf
                        @method('put')

                        <button type="submit" name="status" value="{{ $restaurant->status }}" class="btn3 flex-c-m size13 txt11 trans-0-4 m-l-r-auto">
                            @if($restaurant->status == 'open') Close it @else Open it @endif
                        </button>
                    </form>

                </li>

                <li class="t-center m-t-10 m-b-13">
                    <a href="{{ route('ManageFood.index') }}" class="text-19">Manage Food</a>
                </li>

                <li class="t-center m-t-10 m-b-13">
                    <a href="{{ route('comments') }}" class="text-19">Manage Comments</a>
                </li>

                <li class="t-center m-t-10 m-b-13">
                    <a href="{{ route('order.History') }}" class="text-19">Orders Archive</a>
                </li>

                <li class="t-center m-t-10 m-b-13">
                    <a href="{{ route('Restaurant.create') }}" class="text-19">Settings</a>
                </li>

                <li class="t-center m-t-10 m-b-13">
                    <a href="{{ route('Schedule.create') }}" class="text-19">Set restaurant schedule</a>
                </li>

            @endif

            <li class="t-center m-b-33">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="txt19">Logout</button>
                </form>
            </li>
        </ul>
    </aside>
@endsection

@section('content')

    <section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url({{ asset('dashboard/img/bg-title-page-03.jpg') }});">
        <h2 class="txt1 t-center">
            Archive
        </h2>
    </section>

    @if($orders->first())
        @foreach($orders as $order)
            <div class="card mx-auto p-3 bg-light">
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Order Id : {{ $order->id ?? '' }}</h6>
                    <h5 class="mb-1 mt-3">Foods</h5>
                    <ul class="ml-3 mb-3">
                        @foreach($order->foods as $food)
                            <li>{{ $food->name . ' ⇒ ' . $food->getOriginal()['pivot_count'] }}</li>
                        @endforeach
                    </ul>
                    <p class="card-text"><span class="text-danger">Level: {{ $order->seller_status ?? '' }}</span></p>
                </div>

                <div class="progress">
                    @if($order->seller_status == 'pending')
                        <div class="progress-bar" role="progressbar"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif($order->seller_status == 'preparing')
                        <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40%" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif($order->seller_status == 'send')
                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80%" aria-valuemin="0" aria-valuemax="100"></div>
                    @elseif($order->seller_status == 'delivered')
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100%" aria-valuemin="0" aria-valuemax="100"></div>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="mt-3 text-center">
            {{ $orders->links() }}
        </div>

    @endif

@endsection

