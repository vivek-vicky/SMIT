<?php

//use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('scrape', 'ApiController@getScrape');
Route::get('add_address', 'ApiController@getAddAddress');
//Route::post('scrape', 'ApiController@Scrape');
//Route::post('login', 'AuthController@login');
//Route::post('recover', 'AuthController@recover');