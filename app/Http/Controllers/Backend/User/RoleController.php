<?php

namespace App\Http\Controllers\Backend\User;

use App\Models\User\AdminUser;
use App\Repositories\Interfaces\User\AdminUserRepository;
use App\Repositories\Interfaces\User\UserRepository;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    /**
     * @var
     */
    protected $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * 角色列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $token = getToken();
        $user  = getAdminUser();

        if (request('role_id')){
            $role = Role::query()->find(request('role_id'));
        }else{
            $role = Role::query()->get();
        }
        if (request('type')){
            if (request('role_id')){
                $role = Role::query()->find(request('role_id'));
                $role = [$role];
            }else{
                $role = Role::query()->get();
            }
            $count = Role::query()->count();
            return  listJson(0,'角色列表',$count,$role);
        }

        return view('backend.user.administrators.role',compact('token','user','role'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $token = getToken();
        $user  = getAdminUser();
        $permission = Permission::query()->get();
        $role = Role::query()->find($id);
        return view('backend.user.administrators.roleform',compact('token','user','permission','role'));
    }

    /**
     * 角色编辑
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $token = getToken();
        $user  = getAdminUser();
        $permission = Permission::query()->get();
        return view('backend.user.administrators.roleform',compact('token','user','permission'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        $arr = $this->array($request->permission,$role->id);
        db('role_has_permissions')->insert($arr);
        return json(0,'创建成功',[
            'code' => 1001
        ]);
    }

    /**
     * @param $data
     * @return array
     */
    public function array($data,$role_id)
    {
        $newData = [];
        foreach ($data as $k => $v) {
            $newData[$k]['permission_id'] = $v;
            $newData[$k]['role_id'] = $role_id;
        }
        return $newData;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $token = getToken();
        $user  = getAdminUser();
        $permission = Permission::query()->get();
        $role = Role::query()->find($id);
        $arr = db('role_has_permissions')->where('role_id',$id)->get('permission_id')->toArray();
        $arr = array_column($arr,'permission_id');
        return view('backend.user.administrators.roleform',compact('token','user','permission','role','arr'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        Role::query()->where('id',$id)->update(['name' => $request->name]);
        db('role_has_permissions')->where('role_id',$id)->delete();
        $arr = $this->array($request->permission,$id);
        db('role_has_permissions')->insert($arr);
        return json(0,'更新成功',[
            'code' => 1001
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Role::query()->where('id',$id)->delete();
        db('role_has_permissions')->where('role_id',$id)->delete();
        db('user_has_roles')->where('role_id',$id)->delete();
        return json(0,'删除成功',[
            'code' => 1001
        ]);
    }
}
