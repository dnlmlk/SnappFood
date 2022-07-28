<?php

namespace App\Http\Controllers;

use App\Models\RestaurantCategories;
use Illuminate\Http\Request;

class RestaurantCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = RestaurantCategories::paginate(5);
        return view('admin.restaurantCategory.RestaurantCategories',['categories' => $categories]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RestaurantCategories::insert([
            'name' => $request->input('name')
        ]);
        return redirect()->route('RestaurantCategories.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.restaurantCategory.editRestaurantCategory', ['id' => $id, 'name' => RestaurantCategories::find($id)->name]);
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
        $category = RestaurantCategories::find($id);
        $category->name = $request->input('editedName');
        $category->save();
        return redirect()->route('RestaurantCategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RestaurantCategories::destroy($id);
        return redirect()->route('RestaurantCategories.index');
    }

    public function sendDeleteParam($id){
        return $this->destroy($id);
    }
}
