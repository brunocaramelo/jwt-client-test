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
    Route::get('/', '\App\Admin\Users\UsersController@index');
    Route::get('edit/{id}', '\App\Admin\Users\UsersController@edit');
    Route::post('edit', '\App\Admin\Users\UsersController@update');
    Route::get('new', '\App\Admin\Users\UsersController@add');
    Route::post('new', '\App\Admin\Users\UsersController@insert');
    Route::post('remove', '\App\Admin\Users\UsersController@exclude');
});
