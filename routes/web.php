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
Route::get('/sendDeleted/{id}', [\App\Http\Controllers\FoodCategoriesController::class, 'sendDeleteParam'])->whereNumber('id')->name('FoodCategories.sendDeleteParam')->middleware(['admin', 'auth']);

Route::get('/dashboardd', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
