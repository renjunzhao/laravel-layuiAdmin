<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Spatie\Permission\Models\Permission;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Menu extends Model implements  Transformable
{
    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'menus';

    protected $fillable = [
        'pid',
        'title',
        'sort',
        'group',
        'is_show',
        'is_developer',
        'describe',
        'url',
        'icon',
    ];

    /**
     * @return array
     */
    public function transform()
    {
        $data = $this->toArray();
        if ($data['pid'] == 0){
            $data['_title'] = '顶级菜单';
        }else{
            $menus = Menu::query()->find($data['pid']);
            $data['_title'] = $menus->title;
        }
        return $data;
    }


    public function childCategory() {
        return $this->hasMany('App\Models\System\Menu', 'pid', 'id');
    }

    public function allChildrenCategory()
    {
        return $this->childCategory()->with('allChildrenCategory');
    }

    public function childCategory1() {
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
        return $this->hasMany('App\Models\System\Menu', 'pid', 'id')->whereIn('title',$arr_name);
    }

    public function allChildrenCategory1()
    {
        return $this->childCategory()->with('allChildrenCategory');
    }



}
