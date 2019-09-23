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
//测试添加页面
Route::prefix('/Goods')->middleware('Login')->group(function(){
    Route::get('GoodsCart','Goods\\CartListController@index');//购物车列表页
    Route::get('CartListDel','Goods\\CartListController@cartListDel');//购物车列表删除
    Route::get('CartListNum','Goods\\CartListController@CartListNum');//购物车列表购买数量

<<<<<<< HEAD
    Route::get('GoodsList','Goods\\GoodsListController@index');//商品首页
    Route::get('GoodsDetail','Goods\\GoodsDetailController@goodsDetail');//商品详情
    Route::get('GoodsCart','Goods\\CartListController@index');
    Route::get('GoodsList','Goods\\GoodsListController@index');//商品首页
    Route::post('addCart','Goods\\GoodsDetailController@addCart');   //点击加入购物车
    Route::any('code',"LoginController@code"); 
    //Route::any('index',"LoginController@index");
}); 
    Route::any('Goods/code',"LoginController@code");
    Route::any('register',"LoginController@register");   
    Route::any('Goods/registerdo',"LoginController@registerdo");  
    Route::any('Goods/login',"LoginController@login");
    Route::any('logindo',"LoginController@logindo");
    Route::any('registerdo',"LoginController@registerdo");
    Route::any('index',"LoginController@index");



