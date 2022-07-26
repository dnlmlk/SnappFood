<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users|email',
            'role' => 'exists:customer',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'role' => 'customer',
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('token_base_name')->plainTextToken;

        return response(['Message' =>'You registered successfully', 'Token' => $token], 201);
    }

    public function logOut()
    {
        auth()->user()->tokens()->delete();
        return response(['Message' => 'you log outed']);
    }

    public function logIn(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'exists:customer'
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return response(['Message' => 'you are log in', 'Token' => $user->createToken('token_base_name')->plainTextToken]);
    }

}
