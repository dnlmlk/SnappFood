<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::resource('RestaurantCategories', \App\Http\Controllers\RestaurantCategoriesController::class)->middleware(['admin', 'auth']);
Route::get('/sendDelete/{id}', [\App\Http\Controllers\RestaurantCategoriesController::class, 'sendDeleteParam'])->whereNumber('id')->name('RestaurantCategories.sendDeleteParam')->middleware(['admin', 'auth']);

Route::resource('FoodCategories', \App\Http\Controllers\FoodCategoriesController::class)->middleware(['auth', 'admin']);
Route::get('/sendDeleteeeee/{id}', [\App\Http\Controllers\FoodCategoriesController::class, 'sendDeleteParam'])->whereNumber('id')->name('FoodCategories.sendDeleteParam')->middleware(['admin', 'auth']);

Route::resource('Discount', \App\Http\Controllers\DiscountController::class)->middleware(['auth', 'admin']);
Route::get('/sendDeleted/{id}', [\App\Http\Controllers\DiscountController::class, 'sendDeleteParam'])->whereNumber('id')->name('Discount.sendDeleteParam')->middleware(['admin', 'auth']);

Route::resource('Restaurant', \App\Http\Controllers\RestaurantProfileController::class)->middleware(['auth', 'seller']);

Route::resource('ManageFood', \App\Http\Controllers\FoodController::class)->middleware(['auth', 'seller']);
Route::get('/ManageFood/jQuery/ajax', [\App\Http\Controllers\FoodController::class, 'ajax'])->middleware(['auth', 'seller'])->name('ManageFood.ajax');
Route::get('/ManageFood/jQuery/ajaxSearch', [\App\Http\Controllers\FoodController::class, 'ajaxSearch'])->middleware(['auth', 'seller'])->name('ManageFood.ajaxSearch');

Route::get('/dashboardd', function () {

    if (auth()->user()->role == 'seller') {
        $restaurant = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first();
        $gate = \Illuminate\Support\Facades\Gate::allows('view', $restaurant);
        if($gate == false)  return redirect()->route('Restaurant.index');
    }

    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
