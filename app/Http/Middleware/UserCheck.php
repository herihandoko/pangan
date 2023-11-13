<?php

namespace App\Http\Middleware;

use App\Model\User;
use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class UserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public $user;

    public function handle($request, \Closure $next)
    {
        $user = request()->session()->get('user');
        if(!$user)
        {
            $user_model = new User();
            $user_login = Auth::user()->getAttributes();
            $user = $user_model->where('id', $user_login['id'])->first();
        
            View::share('user', (object) $user);
            $request->session()->put('user', $user);
        }else{
            View::share('user', $user);
        }
        return $next($request);
    }
}
