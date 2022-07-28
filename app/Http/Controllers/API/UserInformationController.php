<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserInformationController extends Controller
{
    public function edit(Request $request)
    {
        $fields = $request->validate([
            'name' => 'string',
            'email' => 'unique:users|email',
            'password' => 'string|confirmed',
        ]);

        $user = User::find(auth()->user()->id);

        $request->name == null ? true : $user->name = $request->name;
        $request->email == null ? true : $user->email = $request->email;
        $request->password == null ? true : $user->password = bcrypt($request->password);

        $user->save();

        return response(['Message' => 'Your personal information updated successfully', 'Information' => new UserResource($user)]);
    }
}
