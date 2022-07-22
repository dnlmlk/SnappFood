<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('Register', [\App\Http\Controllers\API\AuthenticationController::class, 'register'])->name('API.Auth.register');
Route::post('Login', [\App\Http\Controllers\API\AuthenticationController::class, 'logIn'])->name('API.Auth.login');

Route::middleware('auth:sanctum')->group(function ()
{
    Route::resource('Addresses', \App\Http\Controllers\API\AddressController::class);
    Route::post('Addresses/{Address}', [\App\Http\Controllers\API\AddressController::class, 'setActiveAddress'])->name('Address.setActiveAddress');

    Route::get('Logout', [\App\Http\Controllers\API\AuthenticationController::class, 'logOut'])->name('API.Auth.logout');

    Route::apiResource('apiRestaurant', \App\Http\Controllers\API\RestaurantController::class);
    Route::get('apiRestaurant/{id}/foods', [\App\Http\Controllers\API\RestaurantController::class, 'food']);

    Route::get('Carts', [\App\Http\Controllers\API\OrderController::class, 'getCards']);
    Route::post('Carts/Add', [\App\Http\Controllers\API\OrderController::class, 'add']);
    Route::put('Carts/Update', [\App\Http\Controllers\API\OrderController::class, 'update']);
    Route::get('Carts/{cartId}', [\App\Http\Controllers\API\OrderController::class, 'getCard'])->whereNumber('cartId');
    Route::post('Carts/{cartId}/Pay', [\App\Http\Controllers\API\OrderController::class, 'payCard'])->whereNumber('cartId');
    Route::delete('Carts/Delete', [\App\Http\Controllers\API\OrderController::class, 'destroy']);

    Route::post('Comments', [\App\Http\Controllers\API\CommentController::class, 'store']);
    Route::get('Comments', [\App\Http\Controllers\API\CommentController::class, 'index']);

//    Route::delete('Comment/Delete/{id}', function ($id){
//        \App\Models\Comment::find($id)->delete();
//    });
//
//    Route::post('Comment/Restore/{id}', function ($id){
//
//        \App\Models\Comment::withTrashed()->find($id)->restore();
//    });
});
