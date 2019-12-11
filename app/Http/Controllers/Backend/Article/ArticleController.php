<?php

namespace App\Http\Controllers\Backend\Article;

use App\Models\Article\Article;
use App\Models\Article\Category;
use App\Models\Article\Language;
use App\Models\User\AdminUser;
use App\Repositories\Interfaces\Article\ArticleRepository;
use App\Repositories\Interfaces\User\AdminUserRepository;
use App\Repositories\Interfaces\User\UserRepository;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    protected $repository;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $repository
     */
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $token = getToken();
        $user  = getAdminUser();
        $category = Category::query()->get();
        if (request('type')){
            $article = $this->repository->orderBy('sort','desc')->with(['category','user'])->paginate(request('limit',30));
            return listJson(0,'文章列表',$article['meta']['pagination']['total'],$article['data']);
        }else{
            return view('backend.app.content.list',compact('token','user','category'));
        }
    }

    /**
     * 创建
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $token = getToken();
        $user  = getAdminUser();
        $category = Category::query()->get();
        return view('backend.app.content.listform',compact('token','user','category'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->repository->create($request->except('author','token','file','_token'));
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
        $category = Category::query()->get();
        $article = $this->repository->find($id);
        return view('backend.app.content.listform',compact('token','user','category','article'));
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
        $category = Category::query()->get();
        $article = $this->repository->find($id)['data'];
        return view('backend.app.content.listform',compact('token','user','category','article'));
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        $this->repository->update($request->except('author','token','file','_token'),$id);

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
        Article::query()->whereIn('id',$id)->delete();
        return json(0,'删除成功',[
            'code' => 1001
        ]);
    }


}
