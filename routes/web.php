<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','Index\IndexController@index');//首页

Route::get('/reg','User\UserController@reg');//注册
Route::post('/user/regDo','User\UserController@regDo');//注册

Route::get('/login','User\UserController@login');//登录
Route::post('/user/loginDo','User\UserController@loginDo');//登录

Route::get('/user/info','User\UserController@info');//鉴权




