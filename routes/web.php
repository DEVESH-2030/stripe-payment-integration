<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/subscription/', ['as'=>'home','uses'=>'App\Http\Controllers\SubscriptionController@index'])->name('subscription');
Route::get('/subscription/create/{product}', ['as'=>'home','uses'=>'App\Http\Controllers\SubscriptionController@create'])->name('subscription.create');
Route::post('order-post', ['as'=>'order-post','uses'=>'App\Http\Controllers\SubscriptionController@orderPost'])->name('order-post');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
