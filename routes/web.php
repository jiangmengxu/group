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

    Route::get('Goods/GoodsCart','Goods\\CartListController@index');


    Route::get('Goods/GoodsList','Goods\\GoodsListController@index');//商品首页
    Route::get('Goods/GoodsDetail','Goods\\GoodsDetailController@goodsDetail');   //商品详情
