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
        //
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
        $myRequest = $request->all();
        if (is_null($request->input('address')) && $restaurant->address != null) $myRequest['address'] = $restaurant->address;


        $restaurant->update($myRequest);
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
        //
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
}
