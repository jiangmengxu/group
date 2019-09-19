<?php

namespace App\Http\Controllers\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;

class GoodsDetailController extends Controller
{
    public function goodsDetail(Request $request)
    {
        $goods_id = $request->goods_id;
        $data = Goods::where(['goods_id'=>$goods_id])->first()->toArray();
//        dd($data);
        return view('goods.goodsDetail',['data'=>$data]);
    }
}
