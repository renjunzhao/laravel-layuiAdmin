<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Models\User\AdminUser;
use Hashids\Hashids;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;


class LoginController extends Controller
{
    use RedirectsUsers, ThrottlesLogins;


    /**
     * 登陆页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.user.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try{
            $this->validate($request, [
                'captcha' => 'required|captcha'
            ],[
                'captcha.required' => trans('validation.required'),
                'captcha.captcha'  => trans('validation.captcha'),
            ]);

            $credentials = request(['name', 'password']);

            if (! $token = auth('admin')->attempt($credentials)) {
                return json(0,'账号或者密码错误',[
                    'code' => 5001
                ]);
            }


            $user = AdminUser::query()->where('name',request('name'))->first();
            if ($user->is_isable == 1) {
                return json(0,'该账号已被禁用',[
                    'code' => 5001
                ]);
            }

            if (!$user->hasAnyRole(Role::all())){
                return json(0,'没有对应权限',[
                    'code' => 5001
                ]);
            }

            return $this->respondWithToken($token);
        }catch (ValidationException $exception){
            return json(0,'验证码错误',[
                'code' => 5001
            ]);
        }

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('admin')->logout();

        exit("<script>parent.location.reload()</script>");
    }

    /**
     * Refresh a token.
     * 刷新token，如果开启黑名单，以前的token便会失效。
     * 值得注意的是用上面的getToken再获取一次Token并不算做刷新，两次获得的Token是并行的，即两个都可用。
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('admin')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        //更新最后登录ip地址
        AdminUser::query()->where('id',getAdminUser()->id)->update(['ip' => $this->getIp()]);

        return json(0,'登陆成功',[
            'code'    => 1001,
            'token'   => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60
        ]);
    }

    /**
     * 获取当前登陆ip
     * @return mixed
     */
    public function getIp()
    {
        if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }





}
