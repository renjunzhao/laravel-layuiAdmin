<?php

namespace App\Repositories\Article;

use App\Criteria\RequestCriteria;
use App\Models\Article\Article;
use App\Models\Article\Category;
use App\Models\Article\Language;
use App\Repositories\Interfaces\Article\ArticleRepository;
use App\Repositories\Interfaces\Article\CategoryRepository;
use App\Repositories\Interfaces\Article\LanguageRepository;
use App\Validators\Article\ArticleValidator;
use App\Validators\Article\CategoryValidator;
use App\Validators\Article\LanguageValidator;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent.
 */
class LanguageRepositoryEloquent extends BaseRepository implements LanguageRepository
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
        return Language::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return LanguageValidator::class;
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
