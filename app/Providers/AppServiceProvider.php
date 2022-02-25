<?php

namespace App\Providers;

use App\Http\Middleware\SaveLocaleMiddleware;
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
        require_once __DIR__ . '/../Helpers/Helpers.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $this->registerLocaleMiddleware();

        View::composer('web.partials.sidebar', CategoryComposer::class);
        View::composer('web.partials.sidebar', TagComposer::class);
        View::composer('web.partials.sidebar', PostComposer::class);
        // View::composer('*', function ($view) {
        //     $view->with('categories', Category::where('parent_id',0)->get());
        // });
    }
    public function registerLocaleMiddleware()
    {
        $this->app['router']->pushMiddlewareToGroup('web', SaveLocaleMiddleware::class);
    }
}
