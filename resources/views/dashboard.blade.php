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
                    <a href="{{ route('comments.admin') }}" class="txt19">Manage comments</a>
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
                    <a href="{{ route('report') }}" class="text-19">Finance Report</a>
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
            Dashboard
        </h2>
    </section>

    @if(auth()->user()->role == 'seller')
        @php($orders = \Illuminate\Support\Facades\DB::table('orders')->Where('restaurant_id', \App\Models\Restaurant::where('user_id', auth()->user()->id)->first()->id)->where('seller_status', '!=', 'delivered')->where('customer_status', 'paid')->orderBy('created_at', 'desc')->get())
        @php($order = session()->get('order') ?? $orders->first())
        @if($orders->first())
            <div class="card mx-auto p-3" style="width: 18rem; position: fixed; top: 180px; right: 20px">
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Order Id : {{ $order->id ?? '' }}</h6>
                    <h5 class="mb-1 mt-3">Foods</h5>
                    <ul class="ml-3 mb-3">
                        @foreach(\Illuminate\Support\Facades\DB::table('food_order')->where('order_id', $order->id)->get() as $food)
                            <li>{{ \Illuminate\Support\Facades\DB::table('food')->find($food->food_id)->name . ' ⇒ ' . $food->count }}</li>
                        @endforeach
                    </ul>
                    <p class="card-text"><span class="text-danger">Level: {{ $order->seller_status ?? '' }}</span></p>
                </div>

                @isset($order)
                    <div class="progress">
                        @if($order->seller_status == 'pending')
                            <div class="progress-bar" role="progressbar"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        @elseif($order->seller_status == 'preparing')
                            <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40%" aria-valuemin="0" aria-valuemax="100"></div>
                        @elseif($order->seller_status == 'send')
                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80%" aria-valuemin="0" aria-valuemax="100"></div>
                        @endif
                    </div>

                    <form method="post" action="{{ route('order.update') }}">
                        @method('put')
                        @csrf
                        <button class="m-t-20 m-b-20 btn3 flex-c-m size13 txt11 trans-0-4 m-l-r-auto" name="id" value="{{ $order->id }}">Next level</button>
                    </form>
                @endisset

                <form method="get" action="{{ route('order.getOrder') }}">
                    @csrf

                    <select class="form-select px-5" name="order">
                        <option selected disabled>Select order</option>

                        @foreach($orders as $order)
                            <option value="{{ $order->id }}">
                                Order number {{ $order->id }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary mt-2" style="padding-left: 116px; padding-right: 116px">
                        Go
                    </button>
                </form>

            </div>
        @endif
    @endif

@endsection

