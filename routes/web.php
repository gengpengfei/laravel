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
Route::group(['middleware'=>[],'prefix'=>''],function (){
    Route::get('/',['as'=>'/','uses'=>"HomeController@index"]);
    Route::get('login',['as'=>'login','uses'=>"Auth\LoginController@showLoginForm"]);
    Route::post('login',['as'=>'login','uses'=>"Auth\LoginController@login"]);
    Route::post('logout',['as'=>'logout','uses'=>"Auth\LoginController@logout"]);
});

Route::group(['middleware'=>[],'prefix'=>'Pay'],function (){
    Route::any('aliPayWeb',"PayController@aliPayWeb");
    //-- 微信扫码支付
    Route::any('weChatWeb',"PayController@weChatPayWeb");
    //-- 订单查询
    Route::any('weChatFind',"PayController@weChatFind");
});

Route::group(['middleware'=>['auth'],'prefix' => 'Mes'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'MessageController@index']);
    Route::get('create', ['as' => 'create', 'uses' => 'MessageController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'MessageController@store']);
    Route::get('{id}', ['as' => 'show', 'uses' => 'MessageController@show']);
    Route::put('{id}', ['as' => 'update', 'uses' => 'MessageController@update']);
});
//-- Excel 组
Route::group(['middleware'=>[],'prefix' => 'Excel'], function () {
    Route::get('export','ExcelController@export');
    Route::get('import','ExcelController@import');
});
//-- 权限路由组
Route::group(['middleware'=>['auth'],'prefix' => 'Role'], function () {
    Route::get('/','RoleController@index');
    Route::get('create',['as'=>'setRole','uses'=>'RoleController@setRole']);
});
