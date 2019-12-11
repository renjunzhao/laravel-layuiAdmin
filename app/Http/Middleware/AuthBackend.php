<?php

namespace App\Http\Middleware;

use Closure;

class AuthBackend
{
    public function handle($request, Closure $next)
    {
        $auth = auth();
        $auth->shouldUse('admin');
        if ($auth->check()) {
            return $next($request);
        }else{
            return redirect('/');
        }
    }

}
