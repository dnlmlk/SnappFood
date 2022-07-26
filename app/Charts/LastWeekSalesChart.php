<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class LastWeekSalesChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $days = [];
        $sales = [];

        $lastWeek = Carbon::now()->subWeek();


        for ($i = 0; $i < 7; $i++) {
            $days[] = $lastWeek->addDay()->format('Y-m-d');
        }
        $orders = Order::where('restaurant_id', Restaurant::where('user_id', auth()->user()->id)->first()->id)->orderBy('created_at')->get();
        $index = 0;

        foreach ($orders as $order) {
            if (Carbon::now()->diff($order->created_at)->days > 7) unset($orders[$index]);
            $index++;
        }

        foreach ($days as $day) {
            $dailySales = 0;
            foreach ($orders as $order) {
                if ($order->created_at->format('Y-m-d') == $day){
                    $dailySales += 1;
                }
            }
            $sales[] = $dailySales;
        }

        return Chartisan::build()
            ->labels($days)
            ->dataset('Sales', $sales);

    }
}
