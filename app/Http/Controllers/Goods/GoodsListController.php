<?php

namespace App\Http\Controllers\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;

class GoodsListController extends Controller
{
    public function index()
    {
        $page=4;
        $goodsdata = Goods::paginate($page);
        return view('Goods/GoodsList',['goodsdata'=>$goodsdata]);
    }
}
