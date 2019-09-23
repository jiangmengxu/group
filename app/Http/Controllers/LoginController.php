<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redis;
use DemeterChain\C;
use App\Models\User;
class LoginController
{
    //发送短信验证码
    public function code(Request $request)
    {
        $tel=$request->g_tel;
        //dd($tel);
        $code=rand(1000,9999);
        session(['g_tel'=>$tel]);
        session(['code'=>$code]);
        $this->sendMobile($code,$tel);
    }
    /*
     * @content 发送手机验证码
     * @params  $mobile  要发送的手机号
     *
     * */
    private function sendMobile($code,$mobile)
    {
        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = "6d558c541aec4f3e8c7841be1a5d14b7";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "mobile=".$mobile."&param=code%3A".$code."&tpl_id=TP1711063";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        var_dump(curl_exec($curl));
    }
    //注册
    public function register(){
        return view('Goods/register');
    }
    //执行注册
    public function registerdo(Request $request)
    {
        $u_name=$request->u_name;
        //dd($g_name);
        $verifycode=$request->verifycode;
        $code=session("code");
        //dump($verifycode);
        //dd($code);
        if($verifycode!=$code){
            return 4;exit;
        }
        $u_tel=$request->u_tel;
        //dump($g_tel);
        $session_tel=session("g_tel");
        //dump($session_tel);
        //dump($verifycode);die;
        if($u_tel!=$session_tel){
            return 5;exit;
        }
        //die;
        $u_pwd=$request->u_pwd;
        //dump($g_pwd);
        $where=[
            'u_name'=>$u_name
        ];
        //dd($where);
        $User_model=new User;
        $res=$User_model->where($where)->first();
        if($res){
            return 1;
            //用户名已存在
        }else{
            $time=time();
            $arr=$request->all();
            unset($arr['verifycode']);
            unset($arr['_token']);
            $arr['create_time']=$time;
            $arr['code']=$code;
            $arr['u_pwd']=encrypt($arr['u_pwd']);
            //dd($arr);
            $data=$User_model->insert($arr);
            if($data){
                return 2;
                //注册成功
            }else{
                return 3;
                //注册失败
            }
        }
    }
    //登陆
    public function login(){
        return view('Goods/login');    
    }
    //执行登陆
    public function logindo(Request $request){
        if(empty($request->u_name)){
            echo json_encode(['font'=>'姓名不能为空', 'code'=>2]);exit;
        }
        if(empty($request->u_pwd)){
            echo json_encode(['font'=>'密码不能为空', 'code'=>2]);exit;
        }
        $where=[
            'u_name'=>$request->u_name
        ];

        $data=User::where($where)->first();
            $pwd=$data->u_pwd;
        //dump($data);die;
        $pwd=decrypt($data->u_pwd);
        //$pwd=decrypt($pwd);
        //dd(decrypt($data->user_pwd));
        if(!empty($data)){
            if(decrypt($data->u_pwd)==$request->u_pwd){
                // 存储数据到 session...
                return 1;
                session(['name'=>$request->u_name]);
            }else{
                return 2;exit;
            }
        }else{
                return 3;exit;
        }
    }
    //展示
    public function index(Request $request){
            $res=User::get();
        return view('Goods/index',['res'=>$res]);
    } 
}