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

    <section class="bg-title-page p-t-100 p-b-80 p-l-15 p-r-15 bg-dark">
        <h2 class="txt1 t-center">
            Finance Report
        </h2>


        <form action="{{ route('report') }}" method="get" class="d-flex mt-5">

            <div class=" m-auto bg-dark w-100 text-center">
                <select class="form-select" name="filter" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option value="all" selected>All</option>
                    <option value="lastWeek">Last Week</option>
                    <option value="lastMonth">Last Month</option>
                </select>

                <input class="btn btn-primary mt-1 mb-1" type="submit" value="Filter">
            </div>

        </form>


        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-xl-5 col-lg-6">

                    <div class="row ">

                        <div class="col-sm-6">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Total Income <i class="bi bi-cash-coin text-success"></i></h5>
                                    <h3 class="mt-3 mb-3">{{$totalIncome}}$</h3>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-sm-6">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-cart-plus widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Total Sales <i class="bi bi-cart-check text-primary"></i></h5>
                                    <h3 class="mt-3 mb-3">{{ $totalSales }}</h3>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                    <div class="row py-4">
                        <div class="col-sm-6">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-currency-usd widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Average Revenue">Report Of <i class="bi bi-clock-history text-dark"></i></h5>
                                    <h3 class="mt-3 mb-3">{{ $filter }}</h3>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-sm-6">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-pulse widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Growth">Download <i class="bi bi-download text-danger"></i></h5>
                                    <h3 class="mt-3 mb-3">
                                        <form action="{{ route('report.download') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="totalIncome" value="{{ $totalIncome }}">
                                            <input type="hidden" name="totalSales" value="{{ $totalSales }}">
                                            <input type="hidden" name="filter" value="{{ $filter }}">
                                            <button type="submit" class="btn btn-success">Download Report</button>
                                        </form>
                                    </h3>

                                    <h3 class="mt-3 mb-3">
                                        <form action="{{ route('report.orders.download') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="filter" value="{{ $filter }}">
                                            <button type="submit" class="btn btn-success">Download orders history</button>
                                        </form>
                                    </h3>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                </div> <!-- end col -->

                <div class="col-xl-7 col-lg-6 ">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="header-title">Charts</h4>
                            </div>

                            @if($filter == 'lastWeek')
                                <div id="last_week_income_chart" style="height: 300px;">
                                    <span class="text-danger">Incomes</span>
                                </div>
                                <div id="last_week_sales_chart" style="height: 300px;">
                                    <span class="text-danger">Sales</span>
                                </div>

                            @elseif($filter == 'lastMonth')
                                <div id="last_month_income_chart" style="height: 300px;">
                                    <span class="text-danger">Incomes</span>
                                </div>
                                <div id="last_month_sales_chart" style="height: 300px;">
                                    <span class="text-danger">Sales</span>
                                </div>

                            @elseif($filter == 'all')
                                <div id="all_income_chart" style="height: 300px;">
                                    <span class="text-danger">Incomes</span>
                                </div>
                                <div id="all_sales_chart" style="height: 300px;">
                                    <span class="text-danger">Sales</span>
                                </div>
                            @endif


                        </div> <!-- end card-body-->
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
        </div>



        <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
        <!-- Chartisan -->
        <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
        <!-- Your application script -->

        @if($filter == 'lastWeek')
            <script>
                const income_chart = new Chartisan({
                    el: '#last_week_income_chart',
                    url: "@chart('last_week_income_chart')",
                    hooks: new ChartisanHooks()
                        .colors(['#4299E1','#C07EF1','#67C560','#ECC94B'])
                        .datasets('line')
                        .axis(true)
                });

                const sales_chart = new Chartisan({
                    el: '#last_week_sales_chart',
                    url: "@chart('last_week_sales_chart')",
                    hooks: new ChartisanHooks()
                        .colors(['#FE0045','#4299E1','#C07EF1','#67C560','#ECC94B'])
                        .datasets('bar')
                        .axis(true)
                });
            </script>

        @elseif($filter == 'lastMonth')
            <script>
                const income_chart = new Chartisan({
                    el: '#last_month_income_chart',
                    url: "@chart('last_month_income_chart')",
                    hooks: new ChartisanHooks()
                        .colors(['#4299E1','#C07EF1','#67C560','#ECC94B'])
                        .datasets('line')
                        .axis(true)
                });

                const sales_chart = new Chartisan({
                    el: '#last_month_sales_chart',
                    url: "@chart('last_month_sales_chart')",
                    hooks: new ChartisanHooks()
                        .colors(['#FE0045','#4299E1','#C07EF1','#67C560','#ECC94B'])
                        .datasets('bar')
                        .axis(true)
                });
            </script>

        @elseif($filter == 'all')
            <script>
                const income_chart = new Chartisan({
                    el: '#all_income_chart',
                    url: "@chart('all_income_chart')",
                    hooks: new ChartisanHooks()
                        .colors(['#4299E1','#C07EF1','#67C560','#ECC94B'])
                        .datasets('line')
                        .axis(true)
                });

                const sales_chart = new Chartisan({
                    el: '#all_sales_chart',
                    url: "@chart('all_sales_chart')",
                    hooks: new ChartisanHooks()
                        .colors(['#FE0045','#4299E1','#C07EF1','#67C560','#ECC94B'])
                        .datasets('bar')
                        .axis(true)
                });
            </script>
        @endif

    </section>

@endsection
