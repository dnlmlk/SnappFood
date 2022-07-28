<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrders(Request $request)
    {
        $orders = Order::where('restaurant_id', Restaurant::where('user_id', auth()->user()->id)->first()->id)->orderBy('created_at')->get();
        $index = 0;

        if ($request->filter == 'lastWeek') {
            foreach ($orders as $order) {
                if (Carbon::now()->diff($order->created_at)->days > 7) unset($orders[$index]);
                $index++;
            }
        }
        elseif ($request->filter == 'lastMonth'){
            foreach ($orders as $order) {
                if (Carbon::now()->diff($order->created_at)->days > 30) unset($orders[$index]);
                $index++;
            }
        }
        elseif ($request->filter == 'lastYear'){
            foreach ($orders as $order) {
                if (Carbon::now()->diff($order->created_at)->days > 365) unset($orders[$index]);
                $index++;
            }
        }

        return view('seller.report&comment.ordersArchive', ['orders' => $orders]);
    }


    public function getOrder(Request $request)
    {
        $order = Order::find($request->order);
        return redirect()->route('dashboard')->with(['order' => $order]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $order = Order::find($request->id);
        $sellerStatus = $order->seller_status;

        if ($sellerStatus == 'pending') $order->seller_status = 'preparing';
        elseif ($sellerStatus == 'preparing') $order->seller_status = 'send';
        elseif ($sellerStatus == 'send') $order->seller_status = 'delivered';

        $order->save();

        SendEmailJob::dispatch($order);

        return redirect()->route('order.getOrder');
    }


}
