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

Route::middleware('jwt.auth')->post('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'middleware' => 'jwt.auth' ],function(){
   
    Route::group(['prefix' => 'user'],function(){
        // Route::resource('posts','ApiControllers\PostsApiController');
    });
    
});

