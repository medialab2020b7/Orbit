<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', 'APIController@user');  //?api_token='.$token
Route::middleware('auth:api')->post('/profile', 'APIController@updateProfile')->name('update-profile');

Route::get('/users', 'APIController@users');
Route::get('/histories', 'APIController@histories');
Route::get('/emotions', 'APIController@emotions');

Route::middleware('auth:api')->get('/messages', 'APIController@messagesFetch');
Route::middleware('auth:api')->post('/messages', 'APIController@messagesCreate');

Route::middleware('auth:api')->post('/histories', 'APIController@historiesCreate');

Route::get('/cities/{country}', 'APIController@cities');
Route::get('/historiesById/{id}', 'APIController@userEmotionHistoriesFetch');
