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
Route::any('login',"LoginController@login");
Route::any('logindo',"LoginController@logindo");
Route::any('code',"LoginController@code");
Route::any('register',"LoginController@register");
Route::any('registerdo',"LoginController@registerdo");
Route::any('index',"LoginController@index");
