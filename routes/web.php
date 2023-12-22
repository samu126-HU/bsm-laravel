<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
    return view('home');
});

Route::get('/store', function () {
    return view('store');
})->name('store');

Route::view('/contact', 'contact')->name('contact');

Route::view('/address', 'cart.address')->name('address');

Route::get('/cart', function () {
    if (Gate::allows('loggedIn')) {
        return view('cart');
    } else {
        return redirect('/login')->with('error', 'Az oldal megtekintéséhez be kell jelentkeznie.');
    }
})->name('cart');

Route::post('store/category', [CategoryController::class, 'switchCategory'])->name('store/category');

Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart/add');

Route::post('cart/changeQuantity', [CartController::class, 'changeQuantity'])->name('cart/changeQuantity');

Route::post('cart/delete', [CartController::class, 'deleteFromCart'])->name('cart/delete');

Route::post('/contact', [MessageController::class, 'contact'])->name('contact.store');

Route::get('/admin', function () {
    if (Gate::allows('isAdmin')) {
        return view('admin', ['menuId' => 1]);
    } else {
        return abort(403, 'Nem nem, és nem.');
    }
})->name('admin');


Route::view("/admin", 'admin')->name('admin')->middleware('admin');

Route::post('/admin/data/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.data')->middleware('admin');
Route::post('/admin/modify/', [App\Http\Controllers\AdminController::class, 'modify'])->name('admin.modify')->middleware('admin');
Route::post('/admin/insert/', [App\Http\Controllers\AdminController::class, 'insert'])->name('admin.insert')->middleware('admin');
Route::post('/admin/update/', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update')->middleware('admin');
Route::post('/admin/delete/', [App\Http\Controllers\AdminController::class, 'delete'])->name('admin.delete')->middleware('admin');
Route::post('/admin/contact/' , [App\Http\Controllers\AdminController::class, 'contact'])->name('admin.contact')->middleware('admin');


Route::view('/orders', 'cart.orders')->name('orders');

Route::post('cart/order', [CartController::class, 'order'])->name('cart/order');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/book/{book_id}', function (string $bookid) {
    Log::info('bookid: ' . $bookid);
    return view('book')->with('bookid', $bookid);
})->name('book');

