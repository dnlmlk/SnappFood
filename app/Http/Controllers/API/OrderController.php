<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardResource;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{
    public function getCards()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at')->get();

        return response(CardResource::collection($orders));
    }

    public function getCard($id)
    {
        $order = Order::find($id);

        if (Gate::allows('view', $order))
            return response(new CardResource($order));
        else return response(['msg' => "this isn't your cart"]);
    }

    public function add(Request $request)
    {
        $request->validate([
           'food_id' => ['required', Rule::exists('food', 'id')],
            'count' => 'required|integer|min:1'
        ]);

        $order = Order::where(['user_id' => auth()->user()->id, 'restaurant_id' => Food::find($request->food_id)->restaurant->id, 'customer_status' => 'unpaid'])->first();

        if ($order){
            $foods = $order->foods->first()->pivot->pluck('food_id')->toArray();
            if (in_array($request->food_id, $foods)){
                return response('this food is exist already');
            }
            else{
                $order->foods()->attach(['food_id' => $request->food_id], ['count' => $request->count]);
            }
        }

        else {
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'restaurant_id' => Food::find($request->food_id)->restaurant->id,
            ]);

            $order->foods()->attach(['food_id' => $request->food_id], ['count' => $request->count]);
        }
        return response(['msg' => 'food added successfully', 'cart_id' => $order->id]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'food_id' => ['required', Rule::exists('food', 'id')],
            'count' => 'required|integer|min:1'
        ]);

        $order = Order::where('restaurant_id', Food::find($request->food_id)->restaurant->id)->first();

        $gate = Gate::inspect('update', $order);

        if ($gate->allowed()) {

            $foods = $order->foods->first()->pivot->pluck('food_id')->toArray();
            if (!in_array($request->food_id, $foods)) return response("this food isn't added yet");

            $pivot = $order->foods->first()->pivot->where('food_id', $request->food_id)->first();
            $pivot->count = $request->count;
            $pivot->save();

            return response('count of food is updated');
        }

        return response(['msg' => $gate->message()]);

    }

    public function destroy(Request $request)
    {
        $request->validate([
            'food_id' => ['required', Rule::exists('food', 'id')],
        ]);

        $order = Order::where('restaurant_id', Food::find($request->food_id)->restaurant->id)->first();

        $gate = Gate::inspect('update', $order);

        if ($gate->allowed()) {

            $foods = $order->foods->first()->pivot->pluck('food_id')->toArray();
            if (!in_array($request->food_id, $foods)) return response("this food isn't added yet");

            $pivot = $order->foods->first()->pivot->where('food_id', $request->food_id)->first();
            $pivot->delete();

            return response('food is deleted');
        }

        return response(['msg' => $gate->message()]);

    }


    public function payCard($id)
    {
        $order = Order::find($id);

        $gate = Gate::inspect('pay', $order);

        if ($gate->allowed()){
            $order->customer_status = 'paid';
            $order->save();
             return response(['msg' => "cart number $id paid successfully"]);
        }

        return response(['msg' => $gate->message()]);
    }
}
