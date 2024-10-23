<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\RoleMenu;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Html\Builder;

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
        Builder::useVite();
        Gate::define('viewPulse', function (User $user) {
            return true;
        });

        View::composer('*', function () {
            if (auth()->check()) {
                $menus = [];

                if (!auth()->user()->hasRole('superadmin')) {
                    $menus = RoleMenu::join('menus', 'menus.id', 'role_menus.menu_id')
                                    ->where('role_id', auth()->user()->roles->first()->id)
                                    ->orderBy('menus.sequence', 'asc')
                                    ->get();
                } else {
                    $menus = Menu::orderBy('sequence', 'asc')->get();
                }

                View::share('menus', $menus);
                View::share('key', 'value');
            }
        });
    }
}
