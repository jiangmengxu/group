<?php

namespace App\Http\Controllers\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsListController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $goodsdata = \DB::table('g_goods')->get();
//        dd($goodsdata);
=======
        $page=4;
        $goodsdata = \DB::table('g_goods')->paginate($page);
//        dd($data);
>>>>>>> 9ca7bcd5147a49352a071da1ecc68a0d7e5dfa4d
        return view('Goods/GoodsList',['goodsdata'=>$goodsdata]);
    }
}
