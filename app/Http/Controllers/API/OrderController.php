<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardResource;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Auth\Access\Response;
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
        else return response(['Message' => "this isn't your cart"]);
    }

    public function add(Request $request)
    {
        $request->validate([
           'food_id' => ['required', Rule::exists('food', 'id')],
            'count' => 'required|integer|min:1'
        ]);

        $order = Order::where(['user_id' => auth()->user()->id, 'restaurant_id' => Food::find($request->food_id)->restaurant->id, 'customer_status' => 'unpaid'])->first();

        if ($order){
            $foods = $order->foods->pluck('id')->toArray();
            if (in_array($request->food_id, $foods)){
                return response(['Message' => 'This food is exist to your card already']);
            }
            else{
                $order->foods()->attach(['food_id' => $request->food_id], ['count' => $request->count]);

                $totalPrice = $order->total_price;
                $order->total_price = $totalPrice + Food::find($request->food_id)->final_price * $request->count;
                $order->save();
            }
        }

        else {
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'restaurant_id' => Food::find($request->food_id)->restaurant->id,
                'total_price' => Food::find($request->food_id)->final_price * $request->count
            ]);

            $order->foods()->attach(['food_id' => $request->food_id], ['count' => $request->count]);
        }
        return response(['Message' => 'Food added to card successfully', 'Cart ID' => $order->id]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'food_id' => ['required', Rule::exists('food', 'id')],
            'count' => 'required|integer|min:1'
        ]);

        $order = Order::where(['restaurant_id' => Food::find($request->food_id)->restaurant->id, 'user_id' => auth()->user()->id, 'customer_status' => 'unpaid'])->first();
        if ($order == null) return \response(['Message' => "You don't have unpaid card"]);

        $gate = Gate::inspect('update', $order);

        if ($gate->allowed()) {

            $foods = $order->foods->first()->pivot->pluck('food_id')->toArray();
            if (!in_array($request->food_id, $foods)) return response("this food isn't added yet");

            $pivot = $order->foods->first()->pivot->where('food_id', $request->food_id)->first();
            $food_id = $pivot->food_id;
            $oldCount = $pivot->count;
            $pivot->count = $request->count;
            $pivot->save();

            $order->total_price += ((Food::find($food_id)->final_price * $request->count) - (Food::find($food_id)->final_price * $oldCount));
            $order->save();

            return response(['Message' => 'count of food is updated']);
        }

        return response(['Message' => $gate->message()]);

    }

    public function destroy(Request $request)
    {
        $request->validate([
            'food_id' => ['required', Rule::exists('food', 'id')],
        ]);

        $order = Order::where(['restaurant_id' => Food::find($request->food_id)->restaurant->id, 'user_id' => auth()->user()->id, 'customer_status' => 'unpaid'])->first();
        if ($order == null) return \response(['Message' => "You don't have unpaid card"]);


        $gate = Gate::inspect('update', $order);

        if ($gate->allowed()) {

            $foods = $order->foods->first()->pivot->pluck('food_id')->toArray();
            if (!in_array($request->food_id, $foods)) return response(['Message' => "this food isn't added yet"]);

            $pivot = $order->foods->first()->pivot->where('food_id', $request->food_id)->first();


            $order->total_price -= (Food::find($request->food_id)->final_price * $pivot->count);

            $pivot->delete();

            $order->save();

            return response(['Message' => 'food is deleted']);
        }

        return response(['Message' => $gate->message()]);

    }


    public function payCard($id)
    {
        $order = Order::find($id);

        $gate = Gate::inspect('pay', $order);

        if ($gate->allowed()){
            $order->customer_status = 'paid';
            $order->save();
             return response(['Message' => "cart number $id paid successfully"]);
        }

        return response(['Message' => $gate->message()]);
    }
}
