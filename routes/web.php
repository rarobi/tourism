<?php
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

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\VisaController;

Route::group(['middleware' => ['web']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/home/error', [HomeController::class, 'showError'])->name('home.error');

    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'loginCheck'])->name('login.loginCheck');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout.index');

    Route::get('/sign-up', [SignUpController::class, 'index'])->name('sign-up.index');
    Route::post('/sign-up', [SignUpController::class, 'register'])->name('sign-up.register');

    Route::get('/visa', [VisaController::class, 'index'])->name('visa.index');

    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking-success', [BookingController::class, 'bookingSuccessForCash'])->name('booking.success');
    Route::post('/packages/book', [BookingController::class, 'bookPackage'])->name('package.book');
    Route::post('/promocode-check', [BookingController::class, 'checkPromo'])->name('package.promo');
    Route::post('/children-check', [BookingController::class, 'checkChildren'])->name('package.children-count');

    Route::get('/packages/set-session', 'PackageController@setSession');
    Route::get('/packages/search-packages', 'PackageController@searchPackage');
    Route::resource('/packages', 'PackageController', ['names' => [
        'index'     => 'packages.index',
        'show'      => 'packages.show',
    ]]);

    Route::get('/profile/history', 'ProfileController@history')->name('profile.history');
    Route::resource('/profile', 'ProfileController', ['names' => [
        'index'     => 'profile.index',
        'store'     => 'profile.store'
    ]]);

    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');


    Route::get('/hotels/get-session',[HotelController::class, 'getSession'])->name('hotel.get-session');
    Route::patch('/hotels/search',[HotelController::class, 'search'])->name('hotel.search');
    Route::get('/hotels/destination/ajax-search',[HotelController::class, 'destinationAjaxSearch'])->name('hotel.destination-ajax-search');
    Route::get('/hotels/details/{hotelCode}',[HotelController::class, 'details'])->name('hotel.details');
    Route::get('/hotels/payment/{TID}',[HotelController::class, 'payment'])->name('hotel.payment');

    Route::get('/error', [HotelController::class, 'showError'])->name('hotel.error');
    Route::post('/hotels/book', [HotelController::class, 'bookHotel'])->name('hotels.book');

    Route::post('/hotel/payment/{booking_reference}', [HotelController::class, 'successHotel']);
    Route::post('/hotel/payment-fail', [HotelController::class, 'failHotel']);
    Route::post('/hotel/payment-cancel', [HotelController::class, 'cancelHotel']);
    Route::post('/hotels/roomData', 'HotelController@roomData');

    Route::post('/package/payment/{booking_reference}', 'PackageController@success');
    Route::post('/package/payment-fail', 'PackageController@fail');
    Route::post('/package/payment-cancel', 'PackageController@cancel');
    Route::get('/verification/{code}', 'SignUpController@verify');

    // SSLCOMMERZ Start
//    Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
//    Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');
//    Route::post('/pay', 'SslCommerzPaymentController@index');
//    Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

//    Route::post('/ipn', 'SslCommerzPaymentController@ipn');
    //SSLCOMMERZ END

});






