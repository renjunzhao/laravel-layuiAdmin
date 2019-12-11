<?php

namespace App\Repositories\System;

use App\Criteria\RequestCriteria;
use App\Models\Article\Article;
use App\Models\Article\Category;
use App\Models\System\Menu;
use App\Models\System\System;
use App\Repositories\Interfaces\Article\ArticleRepository;
use App\Repositories\Interfaces\Article\CategoryRepository;
use App\Repositories\Interfaces\System\MenuRepository;
use App\Repositories\Interfaces\System\SystemRepository;
use App\Validators\Article\ArticleValidator;
use App\Validators\Article\CategoryValidator;
use App\Validators\System\MenuValidator;
use App\Validators\System\SystemValidator;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent.
 */
class MenuRepositoryEloquent extends BaseRepository implements MenuRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title' => 'like'
    ];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return MenuValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria (app (RequestCriteria::class));
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return 'Prettus\\Repository\\Presenter\\ModelFractalPresenter';
    }
}
