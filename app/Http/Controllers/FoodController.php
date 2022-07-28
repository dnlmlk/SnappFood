<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Food;
use App\Models\FoodCategories;
use App\Models\Restaurant;
use Illuminate\Auth\Access\Gate;
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

        $foods = Food::all();
        foreach ($foods as $index => $food) {
            $gate = \Illuminate\Support\Facades\Gate::allows('view' , $food);
            if ($gate == false) unset($foods[$index]);
        }

        foreach ($foods as $food) {
            $categories[$food->foodCategory->id] = $food->foodCategory->name;
        }

        if (count($categories) > 0)
            $max = max(array_keys($categories));
        else $max = 0;


        return view('seller.menu.manageFood', ['foods' => $foods, 'categories' => $categories, 'max' => $max]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = FoodCategories::pluck('name', 'id');
        $discounts = Discount::all();

        return view('seller.menu.addFood', ['categories' => $categories, 'discounts' => $discounts]);
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
                'restaurant_id' => Restaurant::where('user_id', auth()->user()->id)->first()->id,
                'discount_id' => $request->input('discount'),
                'final_price' => isset($request->discount) ? ($request->price) * ((100 - Discount::find($request->discount)->value)/100) : $request->price,
            ]);
        }else{
            Food::insert([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'food_categories_id' => $request->input('foodCategory'),
                'raw_material' => $request->input('material'),
                'restaurant_id' => Restaurant::where('user_id', auth()->user()->id)->first()->id,
                'discount_id' => $request->input('discount'),
                'final_price' => isset($request->discount) ? ($request->price) * ((100 - Discount::find($request->discount)->value)/100) : $request->price,
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

        $gate = \Illuminate\Support\Facades\Gate::allows('view' , $food);
        if ($gate == false) abort(403);

        $categories = FoodCategories::pluck('name', 'id');
        $discounts = Discount::all();


        return view('seller.menu.editFood', ['id' => $id, 'food' => $food, 'categories' => $categories, 'discounts' => $discounts]);
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

        $gate = \Illuminate\Support\Facades\Gate::allows('view' , $food);
        if ($gate == false) abort(403);

        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'food_categories_id' => 'required',
            'imagePath' => 'mimes:jpg,jpeg,png'
        ]);


        if ($request->file('imagePath')) {

            $fileName = 'uploads/foodImages/' . time() . '_' . $request->file('imagePath')->getClientOriginalName();
            $request->file('imagePath')->move(public_path('uploads/foodImages'), $fileName);

            $food->name = $request->input('name');
            $food->price = $request->input('price');
            $food->food_categories_id = $request->input('food_categories_id');
            $food->raw_material = $request->input('raw_material');
            $food->image_path = $fileName;
            $food->discount_id = $request->input('discount_id');
            $food->final_price = isset($request->discount_id) ? ($request->price) * ((100 - Discount::find($request->discount_id)->value)/100) : $request->price;

            $food->save();
        }else{

            $food->update($request->all());
            $food->final_price = isset($request->discount_id) ? ($request->price) * ((100 - Discount::find($request->discount_id)->value)/100) : $request->price;
            $food->save();
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
        $food = Food::find($id);
        $gate = \Illuminate\Support\Facades\Gate::allows('view' , $food);
        if ($gate == false) abort(403);

        Food::destroy($id);
        return redirect()->route('ManageFood.index');
    }

    public function ajax(Request $request){
        $categoryId = $request->input('category');
        $foods = Food::where('food_categories_id', $categoryId)->get();


        if ($categoryId == '0') $foods = Food::all();

        foreach ($foods as $index => $food) {

            $gate = \Illuminate\Support\Facades\Gate::allows('view' , $food);
            if ($gate == false) unset($foods[$index]);
        }


        return view('seller.menu.forAjax', ['foods' => $foods]);
    }

    public function ajaxSearch(Request $request){
        $foods = Food::where('name', 'REGEXP', $request->input('search'))->get();

        foreach ($foods as $index => $food) {

            $gate = \Illuminate\Support\Facades\Gate::allows('view' , $food);
            if ($gate == false) unset($foods[$index]);
        }

        return view('seller.menu.forAjax', ['foods' => $foods]);

    }
}
