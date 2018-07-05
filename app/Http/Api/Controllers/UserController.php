<?php

namespace App\Http\Api\Controllers;

use App\Models\Region;
use App\Models\User;
use App\Notifications\InvoiceSms;
use App\Notifications\InvoiceTable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user  = $request->get('userInfo');
        return $this->returnJson($user,'首页','1');
    }
    /*
     * explain:获取省市区列表
     * authors:Mr.Geng
     * addTime:2017/12/18 18:27
     */
    public function getProvince(Request $request)
    {
        $province = Region::all();
        return $this->returnJson($province,'获取省市区列表','1');
    }

}
