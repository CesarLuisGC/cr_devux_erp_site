<?php

namespace App\Providers;

use Src\Tenant\Modules\System\Menu\Infrastructure\Controllers\MenuController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
        Schema::defaultStringLength(100);
        Paginator::useBootstrap();

        $hostName = $this->app->request->server->all()["HTTP_HOST"];
        $domain = Config::get('global.system.url');

        if ($domain !== $hostName) {
            //Se obtienen los registros de menú que se crea dinamicamente para los Tenant
            View::composer('*', function ($view) {
                $menuController = new MenuController();
                $menus = $menuController->getAll();
                $view->with('menus', $menus);
            });
        }
    }
}