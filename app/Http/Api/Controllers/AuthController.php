<?php
namespace App\Http\Api\Controllers;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    /*
     * explain:测试 Client(url请求) 使用
     * authors:Mr.Geng
     * addTime:2017/12/18 15:43
     */
    public function test(Request $request)
    {
        $client = new Client();
        try {
            $url = request()->root() . '/oauth/token';
            $params =  [
                'grant_type'=>'password',
                'client_id'=>2,
                'client_secret'=>'5Pu7DdvQntK6uavWuqurMi258UcxfvvN8aUuS6F2',
                'username' =>$request->username,
                'password' => $request->password,
            ];
            $respond = $client->request('POST', $url, ['form_params' => $params]);
        } catch (RequestException $exception) {
            return $this->returnJson('1',"服务器请求出错",404);
        }
        if ($respond->getStatusCode() !== 401) {
            return json_decode($respond->getBody()->getContents(), true);
        }
    }
    /*
     * explain:登录接口
     * authors:Mr.Geng
     * addTime:2017/12/18 15:42
     */
    public function login(Request $request){

        if(!Auth::attempt($this->credentials($request),$request->remember = true))
        {
            return $this->returnJson($request->all(),"账号密码不正确",-1);
        }

        $user = Auth::user();
        $user['accessToken'] = $user->createToken(ENV('APP_NAME'))->accessToken;
        return $this->returnJson($user,'登录接口',1);
    }

    /*
     * explain:注册用户
     * authors:Mr.Geng
     * addTime:2017/12/6 16:47
     */
    public function register(Request $request)
    {
        $result = User::where("mobile",$request->get('mobile'))->get();
        if(!$result->isEmpty())
            return $this->returnJson('','手机号已经存在',1);
        $user = $this->create($request->all());
        return $this->returnJson($user,'用户注册',1);
    }

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mobile' => $data['mobile'],
            'password' => bcrypt($data['password'])
        ]);
    }
}