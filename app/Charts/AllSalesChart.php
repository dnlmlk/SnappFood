<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class AllSalesChart extends BaseChart
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

        $firstOrderTime = $orders = Order::where('restaurant_id', Restaurant::where('user_id', auth()->user()->id)->first()->id)->orderBy('created_at')->first()->created_at->subDay();

        while ($firstOrderTime->format('Y-m-d') != Carbon::now()->format('Y-m-d')){
            $days[] = $firstOrderTime->addDay()->format('Y-m-d');
        }

        $orders = Order::where('restaurant_id', Restaurant::where('user_id', auth()->user()->id)->first()->id)->orderBy('created_at')->get();

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
            ->dataset('Income', $sales);
    }
}
