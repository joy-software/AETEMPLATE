<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;

class GroupMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $valid = false;
        $id = $request->route()->parameter('id');
        if(session()->has('group'))
        {
            foreach (session('group') as $group)
            {
                if($group == $id)
                {
                    $valid = true;
                    break;
                }
            }
        }

        if($valid)
        {
            return $next($request);
        }
        else
        {
            return Redirect::back();
        }

    }
}
