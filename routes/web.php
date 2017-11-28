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
    Route::get('/', '\Domain\Admin\Users\Http\UsersController@index');
    Route::get('edit/{id}', '\Domain\Admin\Users\Http\UsersController@edit');
    Route::post('edit', '\Domain\Admin\Users\Http\UsersController@update');
    Route::get('new', '\Domain\Admin\Users\Http\UsersController@add');
    Route::post('new', '\Domain\Admin\Users\Http\UsersController@insert');
    Route::post('remove', '\Domain\Admin\Users\Http\UsersController@exclude');
});
