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
    <section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url({{ asset('rCategories/img/background.jpg') }});">
        <h2 class="txt1 t-center">
            Restaurant Categories
        </h2>
    </section>

    <form class="wrap-form-booking p-t-40 p-b-20" method="post" action="{{ route('RestaurantCategories.store') }}">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <!-- Date -->
                <span class="txt9">
                    Add Category
                </span>

                <div class="wrap-inputdate pos-relative txt10 size12 bo2 bo-rad-10 m-t-3 m-b-23">
                    <input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="name">
                </div>


            </div>
        </div>

        <div class="wrap-btn-booking flex-c-m m-t-6">
            <!-- Button3 -->
            <button type="submit" class="btn3 flex-c-m size13 txt11 trans-0-4">
                Add
            </button>
        </div>
    </form>


        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">Category name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <form method="get">
                        @csrf

                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="submit" class="btn btn-secondary" formaction="{{ route( 'RestaurantCategories.edit', $category->id) }}">Edit</button>
                                    <button type="submit" class="btn btn-secondary" formaction="{{ route('RestaurantCategories.sendDeleteParam', $category->id) }}">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </form>

                @endforeach
            </tbody>
        </table>

    <div class="mt-3">
        {{ $categories->links() }}
    </div>


@endsection
