<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->path();

        // Redirect user to login page if not authenticated

        if(!Auth::check() && (

            $routeName == 'logout' || 
            str_contains($routeName, 'admin') == true || 
            str_contains($routeName, 'dashboard') == true || 
            str_contains($routeName, 'rights-management') == true || 
            str_contains($routeName, 'profile') == true ||
            str_contains($routeName, '201-library') == true ||
            str_contains($routeName, 'api') == true
            
            )){

            return Redirect::to('/login');
        }

        // Redirect already authenticated user to homepage if they accessing the login page

        if(Auth::check() && ($routeName == 'login')){

            return Redirect::to('/');
        }

        return $next($request);
    }
}
