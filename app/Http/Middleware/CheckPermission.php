<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission): Response
    {
        $user = auth()->user();
        $userRole = $user->roles->first();

        if (!$userRole->hasPermission($permission)) {
            return redirect()->back()->with('error', 'You don\'t have permission for this action.');
        }

        return $next($request);
    }
}
