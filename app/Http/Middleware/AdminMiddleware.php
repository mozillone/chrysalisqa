<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Redirect;
use Closure;
use Session;
use App\User;

class AdminMiddleware
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
<<<<<<< HEAD
             
               $roles=User::where('id','=',$request->user()->id)->get()->toArray();
                if (($roles[0]['role_id'] != 1) && ($roles[0]['role_id'] != 2))
=======
               $roles=User::where('id','=',$request->user()->id)->get()->toArray();
                if ($roles[0]['role_id'] != 1)
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3
                {   
                    Session::flash('error', 'No permission for access this page');
                    return Redirect::to("/");  
                }else{

                    return $next($request);
                }
        }
        else
        {
            return Redirect::to('/admin');
        }
      
    }
}
