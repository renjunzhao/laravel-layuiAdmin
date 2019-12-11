<?php

namespace App\Criteria\System;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrderCriteria.
 */
class MenuCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository.
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (request('pid')){
            return $model->where('pid',request('pid'))->where('is_show',1);
        }
        return $model->where('pid',0)->where('is_show',1);
    }
}
