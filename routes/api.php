<?php

use Illuminate\Http\Request;

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

//Route::group(['middleware'=>'auth:api', 'namespace'=>'API'], function(){
	Route::resource('products', 'API\ProductsController')->only(['store', 'update']);
//});


Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');