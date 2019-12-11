<?php

namespace App\Repositories\Interfaces\System;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SmsRepository.
 */
interface SmsRepository extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function sendSms();
}
