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

Route::get('/', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['prefix' => 'users'], function () {
    Route::get('/', '\App\Http\Controllers\Users\UsersController@index');
    Route::get('edit/{id}', '\App\Http\Controllers\Users\UsersController@edit');
    Route::post('edit', '\App\Http\Controllers\Users\UsersController@update');
    Route::get('new', '\App\Http\Controllers\Users\UsersController@add');
    Route::post('new', '\App\Http\Controllers\Users\UsersController@insert');
    Route::post('remove', '\App\Http\Controllers\Users\UsersController@exclude');
});
