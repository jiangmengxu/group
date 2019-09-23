<?php

namespace App\Http\Controllers\Goods;

use DemeterChain\C;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Goods;
class GoodsCheckoutController extends Controller
{
    public function CheckoutIndex()
    {

        $goodsdata = Cart::join('g_goods','g_goods.goods_id','=','g_cart.goods_id')->get()->toArray();
        foreach ($goodsdata as $v){
            $shop_price[]=$v['shop_price']*$v['buy_number'];
        }
        $total=array_sum($shop_price);
        return view('Goods/checkout',['goodsdata'=>$goodsdata],['total'=>$total]);
    }
}
