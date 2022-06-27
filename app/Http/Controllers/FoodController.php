<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodCategories;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = [];
        $ObjCategories = DB::table('food')->select('food_categories.id', 'food_categories.name')->join('food_categories', 'food.food_categories_id', '=', 'food_categories.id')->get();
        foreach ($ObjCategories as $objCategory) {
            $categories[$objCategory->id] = $objCategory->name;
        }
        $categories = array_unique($categories);
        if (count($categories) > 0)
            $max = max(array_keys($categories));
        else $max = 0;

        $food = Food::all();

        return view('manageFood', ['foods' => $food, 'categories' => $categories, 'max' => $max]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = FoodCategories::pluck('name', 'id');
        return view('addFood', ['categories' => $categories]);
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
            'name' => 'required',
            'price' => 'required|integer',
            'foodCategory' => 'required',
            'imagePath' => 'mimes:jpg,jpeg,png'
        ]);

        if ($request->file('imagePath')) {
            $fileName = 'uploads/foodImages/' . time() . '_' . $request->file('imagePath')->getClientOriginalName();
            $path = $request->file('imagePath')->move(public_path('uploads/foodImages'), $fileName);

            Food::insert([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'food_categories_id' => $request->input('foodCategory'),
                'raw_material' => $request->input('material'),
                'image_path' => $fileName,
            ]);
        }else{
            Food::insert([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'food_categories_id' => $request->input('foodCategory'),
                'raw_material' => $request->input('material'),
            ]);
        }
        return redirect()->route('ManageFood.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::find($id);
        $categories = FoodCategories::pluck('name', 'id');

        return view('editFood', ['id' => $id, 'food' => $food, 'categories' => $categories]);
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
        $food = Food::find($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'foodCategory' => 'required',
            'imagePath' => 'mimes:jpg,jpeg,png'
        ]);

        if ($request->file('imagePath')) {
            $fileName = 'uploads/foodImages/' . time() . '_' . $request->file('imagePath')->getClientOriginalName();
            $request->file('imagePath')->move(public_path('uploads/foodImages'), $fileName);

            $food->name = $request->input('name');
            $food->price = $request->input('price');
            $food->food_categories_id = $request->input('foodCategory');
            $food->raw_material = $request->input('material');
            $food->image_path = $fileName;

            $food->save();
        }else{
           $food->update($request->all());
        }
        return redirect()->route('ManageFood.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Food::destroy($id);
        return redirect()->route('ManageFood.index');
    }

    public function ajax(Request $request){
        $categoryId = $request->input('category');
        $foods = DB::table('food')->where('food_categories_id', $categoryId)->get();
        if ($categoryId == '0') $foods = Food::all();
        return view('forAjax', ['foods' => $foods]);
    }

    public function ajaxSearch(Request $request){
//        return $request->input('search');
        $foods = DB::table('food')->where('name', 'REGEXP', $request->input('search'))->get();
        return view('forAjax', ['foods' => $foods]);

    }
}
