<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Locality,
    Promotion,
    Center,
    Right,
    Skill,
    Company,
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        View::composer([
            'offers/index',
            'offers/create',
            'offers/edit',
            'offers/wishlist',
        ], function ($view) {
            $view->with('localities', Locality::query()->oldest('name')->get());
            $view->with('promotions', Promotion::query()->oldest('name')->get());
            $view->with('skills', Skill::query()->oldest('name')->get());
            $view->with('companies', Company::query()->oldest('name')->get());
        });

        View::composer([
            'delegates/index',
            'delegates/create',
            'delegates/edit',
        ], function ($view) {
            $view->with('rights', Right::query()->get());
        });

        View::composer([
            'companies/create',
            'companies/edit',
        ], function ($view) {
            $view->with('localities', Locality::query()->oldest('name')->get());
        });

        View::composer([
            'companies/index',
        ], function ($view) {
            $view->with('skills', Skill::query()->oldest('name')->get());
        });

        View::composer([
            'students/index',
            'students/create',
            'students/edit',
            'tutors/index',
            'tutors/create',
            'tutors/edit',
            'delegates/index',
            'delegates/create',
            'delegates/edit',
        ], function ($view) {
            $view->with('centers', Center::query()->oldest('name')->get());
            $view->with('promotions', Promotion::query()->oldest('name')->get());
        });
    }
}
