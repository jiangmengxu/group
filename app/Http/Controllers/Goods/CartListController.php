<?php

namespace App\Http\Controllers\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartListController extends Controller
{
    //
    public function index(){
        return view('Goods.cartlist');
    }
}
