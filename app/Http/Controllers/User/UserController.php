<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class UserController extends Controller
{
    //注册页面
    public function reg(){
        return view('user.reg');
    }

    //注册
    public function regDo(Request $request){
        $data=$request->except('_token');

        $url='http://passport.1905.com/test/reg';
        $client=new Client();
        $response=$client->request('post',$url,[
            'form_params'=>$data
        ]);

        $json_data=$response->getBody();
        $info=json_decode($json_data,true);
        if($info['errno']) {
            echo "错误信息：" . $info['msg'] . "正在跳转...";
            die;
        }
    }


    //登录视图
    public function login(){
        return view('user.login');
    }

    //登录
    public function loginDo(Request $request){
        $data=$request->except('_token');

        $url='http://passport.1905.com/test/login';
        $client=new Client();
        $response=$client->request('post',$url,[
            'form_params'=>$data
        ]);
        $json_data=$response->getBody();
//        echo $json_data;die;
        $info=json_decode($json_data,true);
//        print_r($info);die;
        if($info['errno']){
            echo "错误信息：" . $info['msg'] . "正在跳转...";
        }

        $uid=$info['data']['uid'];
        $token=$info['data']['token'];

        Cookie::queue('token',$token,300);
        Cookie::queue('uid',$uid,300);


        header('refresh:2,url=/user/info');
        echo "登录成功";

    }

    function info(){
        $uid=Cookie::get('uid');
        $token=Cookie::get('token');

        if(empty($uid)||empty($token)){
            header('refresh:2;url=/login');
            echo "请先登录,页面跳转中";
        }

        //鉴权
        $url='http://passport.1905.com/test/auth';
        $client=new Client();
        $response=$client->request('post',$url,[
           'form_params'=>['uid'=>$uid,'token'=>$token]
        ]);
        $json_data=$response->getBody();
//        print_r($json_data);
        $info=json_decode($json_data,true);

        if($info['errno']){
            echo "错误信息：".$info['errno'];
        }
        echo "欢迎来到个人中心";
    }

}
