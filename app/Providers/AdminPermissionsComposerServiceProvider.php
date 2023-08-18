<?php

namespace App\Providers;

use App\Models\PersonalData;
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

                    $personalData = PersonalData::where('cesno', $user->personal_data_cesno)->first();

                    $view->with([
                        'userPermissions' => $userPermissions,
                        'userRole' => $userRole->role_name,
                        'userName' => $personalData ? $personalData->firstname.' '.$personalData->lastname : null,
                        'userFirstName' => $personalData ? $personalData->firstname : null,
                        'userLastName' => $personalData ? $personalData->lastname : null,
                        'userStatus' => $personalData ? $personalData->status : null,
                        'userTitle' => $personalData ? $personalData->title : null,
                    ]);
                }
            }
        });
    }

    public function register()
    {
        //
    }
}
