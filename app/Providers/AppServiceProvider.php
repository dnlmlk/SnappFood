<?php

namespace App\Providers;

use App\Charts\AllIncomeChart;
use App\Charts\AllSalesChart;
use App\Charts\LastMonthIncomeChart;
use App\Charts\LastMonthSalesChart;
use App\Charts\LastWeekIncomeChart;
use App\Charts\LastWeekSalesChart;
use App\Charts\SampleChart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        $charts->register([
            LastWeekIncomeChart::class,
            LastWeekSalesChart::class,
            LastMonthIncomeChart::class,
            LastMonthSalesChart::class,
            AllIncomeChart::class,
            AllSalesChart::class,
        ]);
        Paginator::useBootstrapFive();
    }
}
