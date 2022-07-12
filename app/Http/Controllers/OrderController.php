<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrders()
    {
        $orders = Order::where('restaurant_id', Restaurant::where('user_id', auth()->user()->id)->first()->id)->orderBy('created_at', 'desc')->paginate(3);
        return view('ordersArchive', ['orders' => $orders]);
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

        return redirect()->route('order.getOrder');
    }


}
