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
});
