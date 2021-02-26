<?php

// use App\Mail\PurchaseMail;
// use Illuminate\Support\Facades\Mail;

use App\Mail\PurchaseMail;
use App\Models\Order;
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

// Route::get('/', function () {
//     return view('shop');
// })->name('main');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');

Route::get('/home', function() {
    if(Auth::user()->role_id == 1) {
        return redirect('/admin');
    } else {
        return view('home');
    }
})->name('home');

Route::get('/authLogout', function() {
    if(Auth::user()) {
        Auth::logout();
        return redirect()->route('shop.index');
    }
})->name('admin.logout');

// Route::view('/product', 'product');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::post('/cart/switchToSaveForLater/{product}', 'CartController@switchToSaveForLater')->name('cart.switch');

Route::delete('/saveForLater/{product}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switchToCart/{product}', 'SaveForLaterController@switchToCart')->name('saveForLater.switch');

Route::get('/empty', function() {
    Cart::destroy();
    Cart::instance('saveForLater')->destroy();
    return redirect()->route('cart.index')->with('success', 'Cart successfully emptied');
});

Route::get('/checkout', 'CheckoutController@index')->name('checkout.index')->middleware('auth');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');

Route::get('/guestCheckout', 'CheckoutController@index')->name('guestCheckout.index');

Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');

Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');

// Email Template View
// Route::get('/email', function() {

//     $order = Order::find(1);
//     return new PurchaseMail($order);
// });

Route::get('/search', 'ShopController@search')->name('search');
