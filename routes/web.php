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

<<<<<<< HEAD
Route::prefix('/goods')->group(function(){
    Route::get('index','Goods\\CartListController@index');
});
=======

<<<<<<< HEAD

Route::prefix('goods')->group(function(){
    Route::get('/detail','Goods\\GoodsDetailController@goodsDetail');   //商品详情
});
=======
    Route::get('Goods/GoodsList','Goods/GoodsListController@index');//商品首页
>>>>>>> 9ce789906a830002e5eb5e0278331f55ad87c531
>>>>>>> df34f3b1980ba1feb8ed35ea1e1dd69f2974f019
