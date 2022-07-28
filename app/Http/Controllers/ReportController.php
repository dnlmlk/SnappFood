<?php

namespace App\Http\Controllers;

use App\Charts\AllSalesChart;
use App\Charts\LastMonthIncomeChart;
use App\Exports\OrderExport;
use App\Exports\ReportExport;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('restaurant_id', Restaurant::where('user_id', auth()->user()->id)->first()->id)->orderBy('created_at')->get();
        $totalIncome = 0;
        $totalSales = 0;

        if ($request->filter == 'lastWeek'){
            foreach ($orders as $order) {
                if (Carbon::now()->diff($order->created_at)->days < 7) {
                    $totalIncome += $order->total_price;
                    $totalSales += 1;
                }
            }
        }

        elseif ($request->filter == 'lastMonth'){
            foreach ($orders as $order) {
                if (Carbon::now()->diff($order->created_at)->days < 30) {
                    $totalIncome += $order->total_price;
                    $totalSales += 1;
                }
            }
        }

        else {
            foreach ($orders as $order) {
                $totalIncome += $order->total_price;
                $totalSales += 1;
            }
        }


        return view('seller.report&comment.report', ['filter' => $request->filter ?? 'all', 'totalIncome' => $totalIncome, 'totalSales' => $totalSales]);
    }

    public function export(Request $request)
    {
        return Excel::download(new ReportExport($request->all()), 'report.xlsx');
    }

    public function orderExport(Request $request)
    {
        return Excel::download(new OrderExport($request->filter), 'orders.xlsx');
    }
}
