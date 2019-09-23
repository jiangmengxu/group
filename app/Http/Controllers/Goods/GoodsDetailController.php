<?php

namespace App\Http\Controllers\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Cart;

class GoodsDetailController extends Controller
{
    //商品详情
    public function goodsDetail(Request $request)
    {
        $goods_id = $request->goods_id;
//        dd($goods_id);
        $data = Goods::where(['goods_id'=>$goods_id])->first();
//        dd($data);
        return view('Goods.goodsDetail',['data'=>$data]);
    }

    //点击加入购物车
    public function addCart(Request $request)
    {
        $goods_id = $request->goods_id;
//        dd($goods_id);
        $data = Cart::insert($goods_id);
        dd($data);

    }

}
