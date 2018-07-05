<?php

namespace App\Http\Home\Controllers;

use App\Models\Market;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = collect(["a"=>1, "b"=>2]);
        $collection2 = collect(["a"=>1,"c"=>3]);
        $a = $collection->crossJoin($collection2)->toArray();
        var_dump($a);die;
        $users = User::paginate(1);
        return view('home',compact('users'));
    }

}
