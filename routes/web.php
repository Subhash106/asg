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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>'auth'], function(){
	Route::get('home/personal-tokens', 'HomeController@getTokens')->name('personal-tokens');
	Route::get('home/clients', 'HomeController@getClients')->name('clients');
	Route::get('home/authorized-clients', 'HomeController@getAuthorizedClients')->name('authorized-clients');
	Route::get('home', 'HomeController@index');
	Route::resource('products', 'ProductsController')->only('index');
});

