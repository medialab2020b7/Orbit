<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'AboutController@index')->name('about');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/giojs', 'GioJSController@index')->name('giojs');

Route::get('/messages/{user?}', 'ChatsController@index')->name('messages');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');

Route::get('/test', 'TestController@index');