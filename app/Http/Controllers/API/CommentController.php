<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use App\Rules\FoodOrderRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use phpDocumentor\Reflection\Types\True_;
use function PHPUnit\Framework\isNull;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'food_id' => ['nullable' ,Rule::requiredIf(is_null($request->restaurant_id)), Rule::exists('food', 'id')],
            'restaurant_id' => ['nullable', Rule::requiredIf(is_null($request->food_id)), Rule::exists('restaurants' ,'id')],
        ]);

        if (!is_null($request->food_id)){
            $comments = Comment::where(['food_id' => $request->food_id, 'user_id' => auth()->user()->id])->orderByDesc('created_at')->get();
            return response(['Comments' => CommentResource::collection($comments)]);
        }

        if (!is_null($request->restaurant_id)){
            $comments = [];
            $orders = Order::where(['restaurant_id'=> $request->restaurant_id, 'user_id' => auth()->user()->id])->get();
            foreach ($orders as $order) {
                foreach ($order->comments as $comment) {
                    $comments[$comment->created_at->format('Y-m-d-H-i-s')] = $comment;
                }
            }
            ksort($comments);
            return response(['Comments' => CommentResource::collection(array_values($comments))]);
        }

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
            'cart_id' => ['required', Rule::exists('orders', 'id')],
            'food_id' => ['required', Rule::exists('food', 'id'), new FoodOrderRule($request->cart_id, $request->food_id)],
            'score' => 'required|integer|min:1|max:5',
            'message' => 'required|string'
        ]);


        $order = Order::find($request->cart_id);
        $gate = Gate::inspect('store', $order);

        if ($gate->allowed()){
            Comment::create([
                'order_id' => $request->cart_id,
                'food_id' => $request->food_id,
                'user_id' => auth()->user()->id,
                'message' => $request->message,
                'score' => $request->score,
            ]);
        }

        return response(['Message' => $gate->message() ?? 'comment created successfully']);


    }

}
