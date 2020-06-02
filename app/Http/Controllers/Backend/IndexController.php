<?php

namespace App\Http\Controllers\Backend;

use App\Models\System\Menu;
use App\Models\System\Setting;
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
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class IndexController extends Controller
{
    /**
     * 首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $token = getToken();
        $user  = getAdminUser();
        $arr = [];
        //获取用户的角色
        $role_id = db('user_has_roles')->where('model_id',$user->id)->first()->role_id;
        //获取角色对应的权限
        $permission_id = db('role_has_permissions')->where('role_id',$role_id)->get('permission_id')->toArray();
        $arr_id = [];
        foreach ($permission_id as $v){
            $arr_id[] = $v->permission_id;
        }
        $permission = Permission::query()->whereIn('id',$arr_id)->get('name')->toArray();
        $arr_name = [];
        foreach ($permission as $v){
            $arr_name[] = $v['name'];
        }
        $menu  = Menu::query()
            ->where('is_show',1)
            ->orderBy('sort','desc')
            ->where('pid',0)
            ->whereIn('title',$arr_name)
            ->get();
        foreach($menu as $v){
            $menus = Menu::query()->with('allChildrenCategory1')->find($v['id'])->toArray();
            $arr[] = $menus;
        }
        //读取设置
        $setting = Setting::query()->first();
        return view('backend.index',compact('token','user','arr','setting'));
    }
}
