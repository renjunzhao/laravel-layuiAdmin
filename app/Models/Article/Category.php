<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Model implements  Transformable
{
    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'category';

    protected $fillable = [
        'name',
        'sort',
        'is_show',
    ];

    /**
     * @return array
     */
    public function transform()
    {
        return $this->toArray();
    }


}
