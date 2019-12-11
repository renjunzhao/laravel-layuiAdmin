<?php

namespace App\Repositories\System;

use App\Criteria\RequestCriteria;
use App\Models\Article\Article;
use App\Models\Article\Category;
use App\Models\System\Setting;
use App\Models\System\System;
use App\Repositories\Interfaces\Article\ArticleRepository;
use App\Repositories\Interfaces\Article\CategoryRepository;
use App\Repositories\Interfaces\System\SystemRepository;
use App\Validators\Article\ArticleValidator;
use App\Validators\Article\CategoryValidator;
use App\Validators\System\SystemValidator;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent.
 */
class SystemRepositoryEloquent extends BaseRepository implements SystemRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Setting::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return SystemValidator::class;
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
