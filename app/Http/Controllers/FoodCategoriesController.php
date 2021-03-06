<?php

namespace App\Http\Controllers;

use App\Models\FoodCategories;
use App\Models\RestaurantCategories;
use Illuminate\Http\Request;

class FoodCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = FoodCategories::paginate(5);
        return view('admin.foodCategory.FoodCategories',['categories' => $categories]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        FoodCategories::insert([
            'name' => $request->input('name')
        ]);
        return redirect()->route('FoodCategories.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.foodCategory.editFoodCategory', ['id' => $id, 'name' => FoodCategories::find($id)->name]);
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
        $category = FoodCategories::find($id);
        $category->name = $request->input('editedName');
        $category->save();
        return redirect()->route('FoodCategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FoodCategories::destroy($id);
        return redirect()->route('FoodCategories.index');
    }

    public function sendDeleteParam($id){
        return $this->destroy($id);
    }
}
