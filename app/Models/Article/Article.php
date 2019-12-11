<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Article extends Model implements  Transformable
{
    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'articles';

    protected $fillable = [
        'title',
        'category_id',
        'language_id',
        'sort',
        'thump_nail',
        'thump',
        'key_word',
        'summary',
        'content',
        'is_show',
        'is_recommend',
        'is_review',
        'release_time',
        'author_id',
        'volume',
    ];

    /**
     * @return array
     */
    public function transform()
    {
        return $this->toArray();
    }

    /**
     * 关联分类
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Article\Category','category_id');
    }


    /**
     * 关联用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User\AdminUser','author_id');
    }

}
