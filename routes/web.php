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

use App\Http\Controllers\UploadVideoController;


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Route::middleware(['auth'])->group(function () {
    Route::resource('channels', 'ChannelController');
}); */
Route::resource('channels', 'ChannelController');

Route::group(['middleware' => ['auth']], function () {

    Route::post('channels/{channel}/videos', [UploadVideoController::class, 'store']) ;

    Route::get('channels/{channel}/videos', [UploadVideoController::class, 'index'])->name('channel.upload');

    Route::resource('channels/{channel}/subscriptions', 'SubscriptionController')->only(['store', 'destroy']);
});

