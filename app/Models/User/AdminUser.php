<?php

namespace App\Models\User;


use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Prettus\Repository\Contracts\Transformable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable implements JWTSubject , Transformable
{
    use HasRoles;
    /**
     * @var string
     */
    protected $table = 'admin_users';

    protected $fillable = [
        'name','password','ip','nickname','remark','is_isable'
    ];

    /**
     * @return array|mixed
     */
    public function transform()
    {
        return $this->transform();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
