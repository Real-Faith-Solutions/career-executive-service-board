<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\AdminPermissionsComposerServiceProvider;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $migrationsPath = database_path('migrations');
        $directories = glob($migrationsPath.'/*', GLOB_ONLYDIR);
        $paths = array_merge([$migrationsPath], $directories);
        // view()->composer('admin.*', AdminPermissionsComposerServiceProvider::class);

        $this->loadMigrationsFrom($paths);
    }
}
