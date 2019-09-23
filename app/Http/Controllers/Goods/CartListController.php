<?php

namespace App\Http\Controllers\Goods;

use App\Model\Cart;
use App\Model\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartListController extends Controller
{
    //
    public function index(){
        $user_id = 1;
        $data = Cart::where(['user_id'=>$user_id,'is_del'=>1])->get()->toArray();
        $count = Cart::where(['user_id'=>$user_id,'is_del'=>1])->count();
        foreach($data as $k=>$v){
            $data[$k]['goods_img'] = Goods::where(['goods_id'=>$v['goods_id']])->value('goods_img');
            $data[$k]['shop_price'] = Goods::where(['goods_id'=>$v['goods_id']])->value('shop_price');
            $data[$k]['goods_name'] = Goods::where(['goods_id'=>$v['goods_id']])->value('goods_name');
        }
        foreach($data as $v){
            $shop_price[] = $v['shop_price']*$v['buy_number'];
        }
        $total_price = array_sum($shop_price);
        return view('Goods.cartlist',compact('data','total_price','count'));
    }

    //购物车列表删除
    public function cartListDel(Request $request){
        $user_id = 1;
        $cart_id = $request->cart_id;
        $res = Cart::where(['user_id'=>$user_id,'cart_id'=>$cart_id])->update(['is_del'=>2]);
        if($res){
            echo "<script>alert('购物车列表信息删除成功');location.href='/Goods/GoodsCart';</script>";
        }
    }

    //购物车列表购买数量
    public function CartListNum(Request $request){
        $user_id = 1;
        $cart_id = $request->cart_id;
        $buy_number = $request->buy_number;
        $goods_id = Cart::where(['user_id'=>$user_id,'cart_id'=>$cart_id])->value('goods_id');
        $goods_number = Goods::where(['goods_id',$goods_id])->value('goods_number');
        if($buy_number > $goods_number){
            return json_encode(['code'=>0,'msg'=>'库存不足']);
        }elseif($buy_number == 0){
            return json_encode(['code'=>0,'msg'=>'购买数量必须大于0']);
        }else{
            $res = Cart::where(['user_id'=>$user_id,'cart_id'=>$cart_id])->update(['buy_number'=>$buy_number]);
            if($res){
                return json_encode(['code'=>1,'msg'=>'购买数量修改成功']);
            }
        }
    }
}
