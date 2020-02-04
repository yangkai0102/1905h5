<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Model\GoodsModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //首页、
    public function index(){

//        GoodsModel::get();

        return view('index.index');
    }
}
