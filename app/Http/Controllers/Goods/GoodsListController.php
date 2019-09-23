<?php

namespace App\Http\Controllers\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;

class GoodsListController extends Controller
{
    public function index()
    {
        $goods_model = new Goods;
        $goodsdata = $goods_model->get();
        $page=4;
        $goodsdata = $goods_model->paginate($page);
        return view('Goods/GoodsList',['goodsdata'=>$goodsdata]);
    }
}
