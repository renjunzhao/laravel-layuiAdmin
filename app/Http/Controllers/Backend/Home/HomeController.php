<?php

namespace App\Http\Controllers\Backend\Home;

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


class HomeController extends Controller
{
    /**
     * 控制台主页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function console()
    {
        $token = getToken();
        $user  = getAdminUser();
        return view('backend.home.console',compact('token','user'));
    }

    /**
     * 主页示例模板一
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homepage1()
    {
        return view('backend.home.homepage1');
    }

    /**
     * 主页示例模板二
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homepage2()
    {
        return view('backend.home.homepage2');
    }
}
