<?php

Route::post('login','ApiAuth\AuthController@authenticate')->middleware('api');
Route::post('get-token','ApiAuth\AuthController@getToken')->middleware('api');
