<?php

namespace App\Http\Controllers\Backend\System;

use App\Models\Article\Category;
use App\Models\System\Setting;
use App\Models\User\AdminUser;
use App\Repositories\Interfaces\Article\CategoryRepository;
use App\Repositories\Interfaces\System\SystemRepository;
use App\Repositories\Interfaces\User\AdminUserRepository;
use App\Repositories\Interfaces\User\UserRepository;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class SystemController extends Controller
{
    /**
     * @var SystemRepository
     */
    protected $repository;

    /**
     * SystemController constructor.
     * @param SystemRepository $repository
     */
    public function __construct(SystemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index()
    {
        $token = getToken();
        $user  = getAdminUser();
        $setting = Setting::query()->first();
        return view('backend.system.website',compact('token','user','setting'));

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        $this->repository->update($request->except('token','_token','file','id'),$id);

        return json(0,'更新成功',[
            'code' => 1001
        ]);
    }


}
