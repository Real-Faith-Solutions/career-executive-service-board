<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Role;
use App\Models\User;

class AdminPermissionsComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function ($view) {
            if (auth()->check()) {
                $user = auth()->user();
                $userRole = $user->roles->first(); // Get the first role of the user

                if ($userRole) {
                    $userPermissions = $userRole->permissions;

                    $view->with('userPermissions', $userPermissions);
                }
            }
        });
    }

    public function register()
    {
        //
    }
}
