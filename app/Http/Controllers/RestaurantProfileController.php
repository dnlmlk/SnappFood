<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantCategories;
use App\Rules\iranianPhoneRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class RestaurantProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first();
        $categories = RestaurantCategories::pluck('name', 'id');
        return view('sellerProfile', ['restaurant' => $restaurant, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurant = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first();
        $categories = RestaurantCategories::pluck('name', 'id');
        return view('editSellerProfile', ['restaurant' => $restaurant, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'phone_number' => ['nullable', 'bail', new iranianPhoneRule],
            'account_number' => 'nullable|bail|integer',
        ]);

        $restaurant = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first();

        $addressRequest = [
            'latitude' => $request->addresses == null ? $restaurant->address->latitude : explode(',', $request->addresses)[0],
            'longitude' => $request->addresses == null ? $restaurant->address->longitude : explode(',', $request->addresses)[1],
            'address' => $request->address,
        ];

        $myRequest = $request->all();
        unset($myRequest['addresses'], $myRequest['address']);


        $restaurant->update($myRequest);

        $restaurant->address()->update($addressRequest);


        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $restaurant = \App\Models\Restaurant::find($id);
        $request->input('status') == 'open' ? $restaurant->update(['status' => 'close']) : $restaurant->update(['status' => 'open']);
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profileUpdate(Request $request){

        $request->validate([
            'phone_number' => ['nullable', 'bail', new iranianPhoneRule],
            'account_number' => 'nullable|bail|integer',
        ]);

        $restaurant = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first();

        $addressRequest = [
            'latitude' => $request->addresses == null ? $restaurant->address->latitude : explode(',', $request->addresses)[0],
            'longitude' => $request->addresses == null ? $restaurant->address->longitude : explode(',', $request->addresses)[1],
            'address' => $request->address,
        ];

        $myRequest = $request->all();
        unset($myRequest['addresses'], $myRequest['address']);


        $restaurant->update($myRequest);

        $restaurant->address()->update($addressRequest);


        return redirect()->route('Restaurant.create');
    }
}
