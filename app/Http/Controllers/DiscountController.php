<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\RestaurantCategories;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::paginate(5);
        return view('admin.discount.discount',['discounts' => $discounts]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Discount::insert([
            'value' => $request->input('value')
        ]);
        return redirect()->route('Discount.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.discount.editDiscount', ['id' => $id, 'value' => Discount::find($id)->value]);
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
        $discount = Discount::find($id);
        $discount->value = $request->input('editedValue');
        $discount->save();
        return redirect()->route('Discount.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Discount::destroy($id);
        return redirect()->route('Discount.index');
    }

    public function sendDeleteParam($id){
        return $this->destroy($id);
    }
}
