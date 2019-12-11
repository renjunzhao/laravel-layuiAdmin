<?php

namespace App\Http\Controllers\Backend\Article;

use App\Models\Article\Category;
use App\Models\User\AdminUser;
use App\Repositories\Interfaces\Article\CategoryRepository;
use App\Repositories\Interfaces\User\AdminUserRepository;
use App\Repositories\Interfaces\User\UserRepository;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 分类列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $token = getToken();
        $user  = getAdminUser();
        if (request('type') == 1){
            $category = $this->repository->orderBy('sort','desc')->paginate(request('limit',30));
            return listJson(0,'分类列表',$category['meta']['pagination']['total'],$category['data']);
        }else{
            return view('backend.app.content.tags',compact('token','user'));
        }
    }

    /**
     * 添加分类
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $token = getToken();
        $user  = getAdminUser();

        return view('backend.app.content.tagsform',compact('token','user'));
    }


    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->repository->create($request->except('token','_token'));
        return json(0,'创建成功',[
            'code' => 1001
        ]);
    }

    /**
     * 编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $token = getToken();
        $user  = getAdminUser();
        $category = $this->repository->find($id);
        return view('backend.app.content.tagsform',compact('token','user','category'));
    }

    /**
     * 编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $token = getToken();
        $user  = getAdminUser();

        $category = $this->repository->find($id)['data'];
        return view('backend.app.content.tagsform',compact('token','user','category'));
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        $this->repository->update($request->except('token','_token'),$id);

        return json(0,'更新成功',[
            'code' => 1001
        ]);
    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return json(0,'删除成功',[
            'code' => 1001
        ]);
    }

    /**
     * 批量删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batch(Request $request)
    {
        $arr = $request->arr;
        $id = [];
        foreach($arr as $v){
            $id[] = $v['id'];
        }
        Category::query()->whereIn('id',$id)->delete();
        return json(0,'删除成功',[
            'code' => 1001
        ]);
    }

}
