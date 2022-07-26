<?php

use Chartisan\PHP\Chartisan;
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
Route::post('Restaurant/updateProfile', [\App\Http\Controllers\RestaurantProfileController::class, 'profileUpdate'])->middleware(['auth', 'seller'])->name('Restaurant.updateProfile');

Route::resource('Schedule', \App\Http\Controllers\ScheduleController::class)->middleware(['auth', 'seller']);

Route::resource('ManageFood', \App\Http\Controllers\FoodController::class)->middleware(['auth', 'seller']);
Route::get('/ManageFood/jQuery/ajax', [\App\Http\Controllers\FoodController::class, 'ajax'])->middleware(['auth', 'seller'])->name('ManageFood.ajax');
Route::get('/ManageFood/jQuery/ajaxSearch', [\App\Http\Controllers\FoodController::class, 'ajaxSearch'])->middleware(['auth', 'seller'])->name('ManageFood.ajaxSearch');

Route::get('Order', [\App\Http\Controllers\OrderController::class, 'getOrder'])->middleware(['auth', 'seller'])->name('order.getOrder');
Route::put('Order/update', [\App\Http\Controllers\OrderController::class, 'update'])->middleware(['auth', 'seller'])->name('order.update');
Route::get('Order/History', [\App\Http\Controllers\OrderController::class, 'getOrders'])->middleware(['auth', 'seller'])->name('order.History');

Route::get('Comment', [\App\Http\Controllers\CommentController::class, 'index'])->middleware(['auth', 'seller'])->name('comments');
Route::delete('Comment/Delete', [\App\Http\Controllers\CommentController::class, 'delete'])->middleware(['auth', 'seller'])->name('comments.delete');
Route::post('Comment/Answer', [\App\Http\Controllers\CommentController::class, 'answer'])->middleware(['auth', 'seller'])->name('comments.answer');

Route::get('Comments/Admin', [\App\Http\Controllers\AdminCommentController::class, 'index'])->middleware(['auth', 'admin'])->name('comments.admin');
Route::post('Comments/Admin/Restore/{id}', [\App\Http\Controllers\AdminCommentController::class, 'restore'])->middleware(['auth', 'admin'])->name('comments.admin.restore');
Route::delete('Comments/Admin/Delete/{id}', [\App\Http\Controllers\AdminCommentController::class, 'delete'])->middleware(['auth', 'admin'])->name('comments.admin.delete');

Route::get('Report', [\App\Http\Controllers\ReportController::class, 'index'])->middleware(['auth', 'seller'])->name('report');
Route::post('Report/Download', [\App\Http\Controllers\ReportController::class, 'export'])->middleware(['auth', 'seller'])->name('report.download');
Route::post('Report/Download/Orders', [\App\Http\Controllers\ReportController::class, 'orderExport'])->middleware(['auth', 'seller'])->name('report.orders.download');


Route::get('/dashboardd', function () {

    if (auth()->user()->role == 'seller') {
        $restaurant = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first();
        $gate = \Illuminate\Support\Facades\Gate::allows('view', $restaurant);
        if($gate == false)  return redirect()->route('Restaurant.index');

        $schedule = \App\Models\Schedule::where('restaurant_id', $restaurant->id)->first();
        if (\Illuminate\Support\Facades\Gate::allows('view', $schedule) == false) return redirect()->route('Schedule.index');
    }

    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
