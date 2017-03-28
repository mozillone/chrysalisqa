<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Redirect;
use Closure;
use Session;
use App\User;

class FronEndUsersMiddleware
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
        if(!empty($request->user()->id))
        {
               $roles=User::where('id','=',$request->user()->id)->get()->toArray();
                if ($roles[0]['role_id'] == 1)
                {   
                    
                    Session::flash('error', 'No permission for access this page');
                    return Redirect::to("/admin");  
                }else{

                    return $next($request);
                }
        }
        else
        {
            return Redirect::to('/login');
        }
      
    }
}
