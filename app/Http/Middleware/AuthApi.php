<?php

namespace App\Http\Middleware;

use Closure;

class AuthApi
{
    public function handle($request, Closure $next)
    {
        $auth = auth();
        $auth->shouldUse('api');
        if (!$auth->check()) {
            return json('5001','token is provide');
        }else{
            return $next($request);
        }
    }

}
