<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderExport implements FromCollection
{
    public $filter;

    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $orders = Order::where('restaurant_id', Restaurant::where('user_id', auth()->user()->id)->first()->id)->orderBy('created_at')->get();
        $index = 0;

        if ($this->filter == 'lastWeek'){
            foreach ($orders as $order) {
                if (Carbon::now()->diff($order->created_at)->days > 7) unset($orders[$index]);
                $index++;
            }
        }

        elseif ($this->filter == 'lastMonth'){
            foreach ($orders as $order) {
                if (Carbon::now()->diff($order->created_at)->days > 30) unset($orders[$index]);
                $index++;
            }
        }


        return $orders;
    }
}
