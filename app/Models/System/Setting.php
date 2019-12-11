<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Setting.
 */
class Setting extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sms',
        'xieyi',
        'email',
        'title',
    ];


    /**
     * 自动格式转换.
     * @var array
     */
    protected $casts = [
        'sms' => 'array',
        'email' => 'array',
    ];
}
