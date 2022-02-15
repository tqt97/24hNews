<?php

namespace App\Providers;

use App\View\Composers\CategoryComposer;
use App\View\Composers\PostComposer;
use App\View\Composers\TagComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();

        View::composer('web.partials.sidebar', CategoryComposer::class);
        View::composer('web.partials.sidebar', TagComposer::class);
        View::composer('web.partials.sidebar', PostComposer::class);
        // View::composer('*', function ($view) {
        //     $view->with('categories', Category::where('parent_id',0)->get());
        // });
    }
}
