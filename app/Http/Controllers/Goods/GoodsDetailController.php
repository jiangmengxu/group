<?php

namespace App\Http\Controllers\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Cart;
use DB;

class GoodsDetailController extends Controller
{
    //商品详情
    public function goodsDetail(Request $request)
    {
        $goods_id = $request->goods_id;
        $data = Goods::where(['goods_id'=>$goods_id])->first();
        return view('Goods.goodsDetail',['data'=>$data]);
    }

    //点击加入购物车
    public function addCart(Request $request)
    {
        $goods_id = $request->goods_id;

//        if(!request()->session()->get('u_id')){
//            return ['code'=>2,'msg'=>'请登陆后在加入购物车'];
//        }
        //加入购物车
//        $u_id = session('u_id');
        $u_id = 1;
        $where = [
            'goods_id' => $goods_id,
            'user_id' => $u_id,
        ];
//         dd($where);
        $cartinfo = Cart::where($where)->first();
//        dd($cartinfo);
        $buy_number = 1;
        $shop_price = Goods::where('goods_id','=',$goods_id)->select('shop_price')->first();
        $goods_number = Goods::where('goods_id','=',$goods_id)->select('goods_number')->first();

        if (empty($cartinfo)) {
            //首次添加入库
            //检测库存
            $res = $this->checkGoodsNumber($buy_number, $goods_number);
            if (!$res) {
                $data = [
                    'code' => '106',
                    'message' => '库存不足',
                    'data' => []
                ];
                return json_encode($data, JSON_UNESCAPED_UNICODE);
            }
            $info = [
                'goods_id' => $goods_id,
                'buy_number' => $buy_number,
                'user_id' => $u_id,
                'add_price' => $shop_price->shop_price
            ];
            $res = Cart::insert($info);
//            dd($res);
            if ($res) {
                $data = [
                    'code' => '200',
                    'message' => '加入购物车成功',
                    'data' => []
                ];
                return json_encode($data, JSON_UNESCAPED_UNICODE);
            } else {
                $data = [
                    'code' => '101',
                    'message' => '加入购物车失败',
                    'data' => []
                ];
                return json_encode($data, JSON_UNESCAPED_UNICODE);
            }

        } else {
            //累计
            $where = [
                'goods_id' => $goods_id,
                'user_id' => $u_id,
            ];
            $alearly_num = Cart::where($where)->first();
//            dd($alearly_num);
            //检测库存
            $res = $this->checkGoodsNumber($buy_number, $goods_number, $alearly_num->buy_number);
            if (!$res) {
                $data = [
                    'code' => '106',
                    'message' => '库存不足',
                    'data' => []
                ];
                return json_encode($data, JSON_UNESCAPED_UNICODE);
            }
            $where = [
                'goods_id' => $goods_id,
                'user_id' => $u_id,
            ];
            $res = Cart::where($where)->update(['buy_number' => $buy_number + $alearly_num->buy_number]);
            if ($res) {
                $data = [
                    'code' => '200',
                    'message' => '加入购物车成功'
                ];
            } else {
                $data = [
                    'code' => '111',
                    'message' => '加入购物车失败',
                    'data' => []
                ];
            }
            die(json_encode($data, JSON_UNESCAPED_UNICODE));
        }


    }

    public  function checkGoodsNumber($buy_number,$goods_number,$alearly_num=0)
    {
        $num = $buy_number+$alearly_num;
        if($num>$goods_number->goods_number){
            return false;
        }else{
            return true;
        }

    }

}
