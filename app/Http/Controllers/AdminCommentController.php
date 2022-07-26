<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Food;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    public function index()
    {
        $commets = Comment::onlyTrashed()->get();
        return view('manageComments', ['comments' => $commets]);
    }

    public function restore($id)
    {
        Comment::withTrashed()->where('id', $id)->restore();
        return redirect()->route('comments.admin');

    }

    public function delete($id)
    {
        Comment::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('comments.admin');
    }
}
