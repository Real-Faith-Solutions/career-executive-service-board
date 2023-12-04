<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = auth()->user();

        if (!$user->hasRole($role)) {
            return redirect()->back()->with('error', 'You don\'t have permission for this action.');
        }

        return $next($request);
    }
}
