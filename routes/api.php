<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([], function(){
    Route::any('login','AuthController@login');
    Route::any('register', 'AuthController@register');
});

Route::group(['middleware' => ['auth.api'],'prefix'=>'User'], function(){
    Route::any('index', 'UserController@index');
    Route::any('getProvince', 'UserController@getProvince');
});
//-- 通知类路由分组
Route::group(['middleware' => ['auth.api'],'prefix'=>'Invoice'], function(){
    Route::any('createDateBase', 'InvoiceController@createDateBase');
    Route::any('getUnread', 'InvoiceController@getUnread');
    Route::any('setRead', 'InvoiceController@setRead');
    Route::any('delRead', 'InvoiceController@delRead');
    Route::any('setRedis', 'InvoiceController@setRedis');
    Route::any('createOrder', 'InvoiceController@createOrder');
});

//-- 队列类路由分组
Route::group(['middleware' => ['auth.api'],'prefix'=>'Queue'], function(){
    Route::any('createOrder', 'QueueController@createOrder');
});

Route::group(['middleware'=>[],'prefix'=>'Index'],function (){
    Route::any('getBanner',"IndexController@getBanner");
    Route::any('newMarket',"IndexController@newMarket");
});
//-- 文件和图片路由组
Route::group(['middleware'=>[],'prefix'=>'Upload'],function (){
    Route::any('createFolder', 'UploadController@createFolder');
    Route::any('deleteFolder', 'UploadController@deleteFolder');
    Route::any('fileList', 'UploadController@fileList');
    Route::any('deleteFile', 'UploadController@deleteFile');
    Route::any('uploadFile', 'UploadController@uploadFile');
    Route::any('uploadBase64', 'UploadController@uploadBase64');
    Route::any('uploadImg', 'UploadController@uploadImg');
    Route::any('getCode', 'UploadController@getCode');
});