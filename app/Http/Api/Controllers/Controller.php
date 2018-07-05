<?php

namespace App\Http\Api\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,AuthenticatesUsers;
    public function __construct(){
        $this->middleware(['api']);
    }
    /*
     * explain:自定义接口返回的格式
     * authors:Mr.Geng
     * addTime:2017/12/15 15:25
     */
    protected function returnJson($data,$msg,$code){
        return response()->json(array("data"=>$data,"msg"=>$msg,"code"=>$code));
    }
}
