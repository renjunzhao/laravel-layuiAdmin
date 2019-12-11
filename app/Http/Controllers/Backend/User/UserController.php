<?php

namespace App\Http\Controllers\Backend\User;

use App\Models\User\AdminUser;
use App\Repositories\Interfaces\User\AdminUserRepository;
use App\Repositories\Interfaces\User\UserRepository;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * @var
     */

    protected $userRepository;
    /**
     * @var AdminUserRepository
     */
    protected $adminUserRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param AdminUserRepository $adminUserRepository
     */
    public function __construct(UserRepository $userRepository,AdminUserRepository $adminUserRepository)
    {
        $this->userRepository = $userRepository;
        $this->adminUserRepository = $adminUserRepository;
    }
    /**
     * 用户信息
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info()
    {
        $token = getToken();
        $user  = getAdminUser();
        $role  = Role::query()->get();
        //获取用户的角色
        $role_id = db('user_has_roles')->where('model_id',$user->id)->first()->role_id;
        return view('backend.user.user.info',compact('token','user','role','role_id'));
    }

    /**
     * 用户信息修改
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function infoEdit(Request $request)
    {
        $data = [
            'nickname' => $request->nickname,
            'remark'   => $request->remark
        ];
        AdminUser::query()->where('id',$request->id)->update($data);
        return json(0,'编辑成功',[
            'code' => 1001
        ]);
    }

    /**
     * 用户修改密码
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function password()
    {
        $token = getToken();
        $user  = getAdminUser();
        return view('backend.user.user.password',compact('token','user'));
    }

    /**
     * 密码修改
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function passwordEdit(Request $request)
    {
        $user = AdminUser::query()->find(request('id'));
        if (!Hash::check($request->oldPassword,$user->password)){
            return json(0,'原密码输入错误',[
                'code' => 5001
            ]);
        }
        AdminUser::query()->where('id',$request->id)->update(['password' => Hash::make($request->password)]);
        return json(0,'修改成功',[
            'code' => 1001
        ]);
    }

    /**
     * 用户列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userList()
    {
        $token = getToken();
        $user  = getAdminUser();
        return view('backend.user.user.list',compact('token','user'));
    }

    /**
     * 列表  1 用户列表 2 管理员列表 3 角色列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listApi(Request $request)
    {
        $type = request('type');
        if ($type == 1){
            $where  = [];
            $where1 = [];
            $where2 = [];
            if (isset($request->username) && $request->username != null){
                $where = [
                    ['username' ,'like', '%'.$request->username.'%'],
                ];
            }
            if (isset($request->email) && $request->email != null){
                $where1 = [
                    'email' => $request->email
                ];
            }
            if (isset($request->is_lock) && $request->is_lock != 0){
                $where2 = [
                    'is_lock' => $request->is_lock
                ];
            }
            $user = User::query()->where($where)->where($where1)->where($where2)->paginate(request('limit',30));
            $count = User::query()->count();
            return listJson(0,'用户列表',$count,$user->items());
        }elseif ($type == 2){
            $where = [];
            if (isset($request->name) && $request->name != []){
                $where = [
                    ['name','like','%'.$request->name.'%']
                ];
            }
            $user = AdminUser::query()->where($where)->paginate(request('limit',30))->items();
            foreach($user as $k => $v){
                $role = db('user_has_roles')->where('model_id',$v->id)->first();
                if ($role){
                    $role_id = $role->role_id;
                    $user[$k]['role_name'] = Role::query()->find($role_id)->name;
                }else{
                    $user[$k]['role_name'] = '无角色';
                }
            }
            $count = AdminUser::query()->count();
            return listJson(0,'后台管理员列表',$count,$user);
        }

    }

    /**
     * 删除  1 用户列表 2 管理员列表 3 角色列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delApi(Request $request)
    {
        $type = request('type');
        if ($type == 1){
            User::query()->where('id',$request->id)->delete();
            return json(0,'删除成功',[
                'code' => 1001
            ]);
        }elseif ($type == 2){
            AdminUser::query()->where('id',$request->id)->delete();
            return json(0,'删除成功',[
                'code' => 1001
            ]);
        }
    }

    /**
     * 删除  1 用户列表 2 管理员列表 3 角色列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelApi(Request $request)
    {
        $type = request('type');
        $arr = $request->arr;
        $id = [];
        foreach($arr as $v){
            $id[] = $v['id'];
        }
        if ($type == 1){
            User::query()->whereIn('id',$id)->delete();
            return json(0,'删除成功',[
                'code' => 1001
            ]);
        }elseif ($type == 2){
            AdminUser::query()->whereIn('id',$id)->delete();
            return json(0,'删除成功',[
                'code' => 1001
            ]);
        }
    }

    /**
     * 添加  1 用户列表 2 管理员列表 3 角色列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createApi(Request $request)
    {
        $type = request('type');
        if ($type == 1){

        }elseif ($type == 2){
            $admin_user = AdminUser::query()->where('name',$request->name)->first();
            if ($admin_user){
                return json(0,'昵称重复',[
                    'code' => 5001
                ]);
            }
            $data = $request->except('_token','token','role','role_id');
            $data['password'] = Hash::make($data['password']);
            $adminUser = AdminUser::query()->create($data);
            $user = AdminUser::query()->where('id',$adminUser->id)->first();
            $role = Role::query()->find($request->role_id);
            if ($role){
                $user->assignRole($role->name);
            }
            return json(0,'添加成功',[
                'code' => 1001
            ]);
        }
    }

    /**
     * 编辑  1 用户列表 2 管理员列表 3 角色列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editApi(Request $request)
    {
        $type = request('type');
        if ($type == 1){
            $user = User::query()->where('id',$request->id)->first();
            if (!$user){
                return json(0,'用户不存在',[
                    'code' => 5001
                ]);
            }
            $data = $request->except('_token','token','file','type');
            $user->update($data);
            return json(0,'更新成功',[
                'code' => 1001
            ]);
        }elseif ($type == 2){
            $admin_user = AdminUser::query()
                ->where('id','<>',$request->id)
                ->where('name',$request->name)->first();
            if ($admin_user){
                return json(0,'昵称重复',[
                    'code' => 5001
                ]);
            }
            $data = $request->except('_token','token','role','role_id','password','type');
            $user = AdminUser::query()->where('id',$request->id)->first();
            $oldRole = db('user_has_roles')->where('model_id',$user->id)->first();
            if ($oldRole){
                $roleOld = Role::query()->find($oldRole->role_id);
                if ($roleOld){
                    $user->removeRole($roleOld->name);
                }
            }

            $role = Role::query()->find($request->role_id);
            if ($role){
                $user->assignRole($role->name);
            }
            AdminUser::query()->where('id',$request->id)->update($data);
            return json(0,'更新成功',[
                'code' => 1001
            ]);
        }
    }

    /**
     * 用户编辑
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userEditForm()
    {
        $token = getToken();
        $user  = getAdminUser();
        $userObj  = '';
        if (request('id')){
            $userObj = User::query()->find(request('id'));
        }
        return view('backend.user.user.userform',compact('token','user','userObj'));
    }

    /**
     * 管理员列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminUserList()
    {
        $token = getToken();
        $user  = getAdminUser();
        return view('backend.user.administrators.list',compact('token','user'));
    }

    /**
     * 管理员编辑
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminUserEditForm()
    {
        $token = getToken();
        $user  = getAdminUser();
        $userObj  = '';
        if (request('id')){
            $userObj = AdminUser::query()->find(request('id'));
        }
        $role = db('user_has_roles')->where('model_id',request('id'))->first();
        $role_id = '';
        if ($role){
            $role_id = $role->role_id;
        }
        $role = Role::query()->get();
        return view('backend.user.administrators.adminform',compact('token','user','userObj','role_id','role'));
    }

}
