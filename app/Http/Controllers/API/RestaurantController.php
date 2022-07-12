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
                $restaurant = Restaurant::where(['status' => $request->is_open, 'restaurant_categories_id' => RestaurantCategories::where('name', $request->type)->first()->id])->get();
            }
            else   $restaurant = Restaurant::where('status', $request->is_open)->get();
        }
        elseif (isset($request->type)) $restaurant = Restaurant::where('restaurant_categories_id', RestaurantCategories::where('name', $request->type)->first()->id)->get();
        else $restaurant = Restaurant::all();

        return RestaurantResource::collection($restaurant);
    }


    public function show($id)
    {
        return new RestaurantResource(Restaurant::find($id));
    }

    public function food($id){
        return new RestaurantFoodsResource(Restaurant::find($id));
    }
}
