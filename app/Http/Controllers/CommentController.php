<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {

        $comments = [];
        $orders = Order::where('restaurant_id', auth()->user()->restaurant->id)->get();
        foreach ($orders as $order) {
            foreach ($order->comments as $comment) {
                if (!is_null($request->food)){
                    if ($comment->food_id == $request->food)
                        $comments[$comment->created_at->format('Y-m-d-H-i-s')] = $comment;
                } else
                    $comments[$comment->created_at->format('Y-m-d-H-i-s')] = $comment;
            }
        }
        krsort($comments);

        $foods = auth()->user()->restaurant->foods;

        return view('comments', ['comments' => $comments, 'foods' => $foods]);
    }

    public function delete(Request $request)
    {
        Comment::destroy($request->id);
        return redirect()->route('comments');
    }

    public function answer(Request $request)
    {
        $comment = Comment::find($request->id);
        $comment->answer = $request->answer;
        $comment->save();

        return redirect()->route('comments');
    }
}
