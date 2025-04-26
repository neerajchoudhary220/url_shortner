<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowShortUrls
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // If user_id is provided, verify it matches the authenticated user
         $msg='Not authorized to access other users\' short URLs';
         $user = auth()->user();
         if($user->hasRole('Member')){
             if ($request->user_id && $user->id != $request->user_id) {
                 abort(403,$msg );
             }
         }

         if($user->hasRole('Admin')){
            if ($request->company_id && $user->company_id != $request->company_id) {
                abort(403, $msg);
            }
         }
        return $next($request);
    }
}
