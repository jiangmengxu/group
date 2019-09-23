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


    Route::get('Goods/GoodsCart','Goods\\CartListController@index');//购物车列表页
    Route::get('Goods/CartListDel','Goods\\CartListController@cartListDel');//购物车列表删除
    Route::get('Goods/CartListNum','Goods\\CartListController@CartListNum');//购物车列表购买数量


Route::get('Goods/GoodsList','Goods\\GoodsListController@index');//商品首页
Route::get('Goods/goodsDetail','Goods\\GoodsDetailController@goodsDetail');   //商品详情
Route::post('Goods/addCart','Goods\\GoodsDetailController@addCart');   //点击加入购物车


Route::any('login',"LoginController@login");
Route::any('logindo',"LoginController@logindo");
Route::any('code',"LoginController@code");
Route::any('register',"LoginController@register");
Route::any('registerdo',"LoginController@registerdo");
Route::any('index',"LoginController@index");

