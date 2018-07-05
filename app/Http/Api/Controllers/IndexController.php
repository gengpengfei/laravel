<?php

namespace App\Http\Api\Controllers;

use App\Models\Ad;
use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $user  = $request->get('userInfo');
        return $this->returnJson($user,'首页','1');
    }
    /*
     * explain:获取轮播图
     * authors:Mr.Geng
     * addTime:2018/1/5 16:14
     */
    public function getBanner()
    {
        $result = Ad::where("position","=","首页banner1")->get();
        if(!$result->isEmpty()){
            foreach ($result as &$v){
                $v->image = $v->image;
            }
        }
        return $this->returnJson($result,'首页轮播图','1');
    }
    /*
     * explain:新鲜速递
     * authors:Mr.Geng
     * addTime:2018/1/5 16:27
     */
    public function newMarket(Request $request)
    {
        $result = Market::where('state','1')->orderBy('create_at','DESC')->take(5)->get();
        if(!$result->isEmpty()){
            foreach ($result as &$v){
                $v->market_img = $v->market_img;
            }
        }
        return $this->returnJson($result,'新鲜速递','1');
    }
}
