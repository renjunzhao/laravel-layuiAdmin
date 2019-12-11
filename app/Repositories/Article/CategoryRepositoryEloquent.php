<?php

namespace App\Repositories\Article;

use App\Criteria\RequestCriteria;
use App\Models\Article\Article;
use App\Models\Article\Category;
use App\Repositories\Interfaces\Article\ArticleRepository;
use App\Repositories\Interfaces\Article\CategoryRepository;
use App\Validators\Article\ArticleValidator;
use App\Validators\Article\CategoryValidator;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent.
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
    ];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return CategoryValidator::class;
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
