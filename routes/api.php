<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'API\RegisterController@action');
Route::post('login', 'API\LoginController@action');
Route::get('me', 'API\UserController@me')->middleware('auth:api');
Route::apiResource('quotes', 'API\QuoteController')->middleware('auth:api');
