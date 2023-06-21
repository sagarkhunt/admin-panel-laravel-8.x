<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $session = UserSession::where('session_id',$request->header('x-access-token'))->first();

        if($session == null){
            return response()->json(['status'=> '0', 'message' => 'Authentication Fail']);
        }
        
        $request['auth_user'] = $session['user_id'];
        
        return $next($request);
    }
}
