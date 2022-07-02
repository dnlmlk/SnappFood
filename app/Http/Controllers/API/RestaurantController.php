<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantFoodsResource;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\ScheduleResource;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\Schedule;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant = Restaurant::all();
        return RestaurantResource::collection($restaurant);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new RestaurantResource(Restaurant::find($id));
    }

    public function food($id){
        return new RestaurantFoodsResource(Restaurant::find($id));
    }
}
