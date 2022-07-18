<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantFoodsResource;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\ScheduleResource;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\RestaurantCategories;
use App\Models\Schedule;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isNull;

class RestaurantController extends Controller
{

    public function index(Request $request)
    {
        $request->validate([
            'is_open' => ['nullable', Rule::in(['open', 'close'])],
            'type' => ['nullable', Rule::exists('restaurant_categories', 'name')]
        ]);


        if (isset($request->is_open)) {
            if (isset($request->type)){
                $restaurants = Restaurant::where(['status' => $request->is_open, 'restaurant_categories_id' => RestaurantCategories::where('name', $request->type)->first()->id])->get();
            }
            else   $restaurants = Restaurant::where('status', $request->is_open)->get();
        }
        elseif (isset($request->type)) $restaurants = Restaurant::where('restaurant_categories_id', RestaurantCategories::where('name', $request->type)->first()->id)->get();
        else $restaurants = Restaurant::all();

        $answer = [];
        $userAddress = auth()->user()->addresses->where('active', 1)->first();

        if ($userAddress == null) return \response(['msg' => "You don't have active Address"]);

        foreach ($restaurants as $restaurant) {
            if ( sqrt(($restaurant->address->longitude - $userAddress->longitude)**2 + ($restaurant->address->latitude - $userAddress->latitude)**2 ) <= 0.05)
                $answer[] = $restaurant;
        }

        return RestaurantResource::collection($answer);
    }


    public function show($id)
    {
        return new RestaurantResource(Restaurant::find($id));
    }

    public function food($id){
        return new RestaurantFoodsResource(Restaurant::find($id));
    }
}
