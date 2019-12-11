<?php

namespace App\Http\Controllers\Backend\System;

use App\Criteria\System\MenuCriteria;
use App\Models\System\Menu;
use App\Repositories\Interfaces\System\MenuRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class MenuController extends Controller
{
    /**
     * @var MenuRepository
     */
    protected $repository;

    /**
     * MenuController constructor.
     * @param MenuRepository $repository
     */
    public function __construct(MenuRepository $repository)
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
        if (request('type') == 1){
            $menu = $this->repository
                ->pushCriteria(new MenuCriteria())
                ->orderBy('sort','desc')
                ->paginate(request('limit',30));
            return listJson(0,'菜单设置',$menu['meta']['pagination']['total'],$menu['data']);
        }else{
            return view('backend.system.menu',compact('token','user'));
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $token = getToken();
        $user  = getAdminUser();
        $rows = Menu::query()
            ->where('is_show',1)
            ->orderBy('sort','desc')
            ->get()->toArray();
        $menus = $this->getTree($rows);
        return view('backend.system.menuform',compact('token','user','menus'));
    }

    /**
     * 创建
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->repository->create($request->except('token','_token'));
        Permission::create(['name' => $request->title]);
        return json(0,'创建成功',[
            'code' => 1001
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $token = getToken();
        $user  = getAdminUser();
        $menu = $this->repository->find($id)['data'];
        $rows = Menu::query()
            ->where('is_show',1)
            ->orderBy('sort','desc')
            ->get()->toArray();
        $menus = $this->getTree($rows);
        return view('backend.system.menuform',compact('token','user','menu','menus'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $token = getToken();
        $user  = getAdminUser();
        $menu = $this->repository->find($id)['data'];
        $rows = Menu::query()
            ->where('is_show',1)
            ->orderBy('sort','desc')
            ->get()->toArray();
        $menus = $this->getTree($rows);
        return view('backend.system.menuform',compact('token','user','menu','menus'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        $title = $this->repository->find($id)['data'];
        Permission::query()->where('name',$title['title'])->update(['name' => $request->title]);
        $this->repository->update($request->except('token','_token'),$id);

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
        $title = $this->repository->find($id)['data'];
        Permission::query()->where('name',$title['title'])->delete();
        $this->repository->delete($id);
        return json(0,'删除成功',[
            'code' => 1001
        ]);
    }

    /**
     * 三级分类
     * @param $data
     * @param string $field_name
     * @param string $field_id
     * @param string $field_pid
     * @param int $pid
     * @return array
     */
    public function getTree($data,$field_name = 'title',$field_id = 'id',$field_pid = 'pid',$pid = 0)
    {
        $arr = [];
        foreach ($data as $k => $v){
            if($v[$field_pid] == $pid){
                $data[$k]["_".$field_name] = $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach ($data as $m => $n){
                    if($n[$field_pid] == $v[$field_id]){
                        $data[$m]["_".$field_name] = '└'.$data[$m][$field_name];
                        $arr[] = $data[$m];
                        foreach ($data as $b => $c){
                            $menu = Menu::query()
                                ->where('is_show',1)
                                ->find($c[$field_pid]);
                            if ($menu && $menu->pid != 0 && $c[$field_pid] == $n[$field_id]){
                                $data[$b]["_".$field_name] = '└─'.$c[$field_name];
                                $arr[] = $data[$b];
                            }
                        }
                    }
                }
            }
        }
        return $arr;
    }
}
