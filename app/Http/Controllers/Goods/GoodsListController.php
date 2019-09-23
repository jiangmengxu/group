<?php

namespace App\Http\Controllers\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsListController extends Controller
{
    public function index()
    {
        $goodsdata = \DB::table('g_goods')->get();
        $page=4;
        $goodsdata = \DB::table('g_goods')->paginate($page);
        return view('Goods/GoodsList',['goodsdata'=>$goodsdata]);
    }
}
