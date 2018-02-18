<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Author
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
        if(Auth::check()){
            $user = Auth::user();
            if($user->is_active == 1 && $user->role->name == "author"){
                return $next($request);
            }
        }
        return redirect()->back();
    }
}
