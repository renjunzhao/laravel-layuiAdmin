<?php

namespace App\Http\Controllers\Backend\System;

use App\Criteria\System\MenuCriteria;
use App\Models\System\Menu;
use App\Repositories\Interfaces\System\MenuRepository;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\System\SystemRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class SmsController extends Controller
{
    /**
     * @var SystemRepository
     */
    protected $repository;

    /**
     * EmailController constructor.
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
        $setting = $this->repository->all();
        $system = $setting['data'][0]['sms'];
        $id = $setting['data'][0]['id'];
        return view('backend.system.sms',compact('token','user','system','id'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        $this->repository->update(['sms' => $request->except('token','_token','id')],$id);

        return json(0,'更新成功',[
            'code' => 1001
        ]);
    }

}
