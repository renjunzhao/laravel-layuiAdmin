<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject , Transformable
{
    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = [
        'password',
        'phone',
        'headimgurl',
        'id_card',
        'is_lock',
        'email',
        'nationality',
        'area_code',
        'inviter_id',
        'username',
    ];

    /**
     * @return array
     */
    public function transform()
    {
        return $this->toArray();
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier(){
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(){
        return [];
    }
}
