<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Company;
use App\Models\BlogCategory;
use App\Models\Type;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        view()->share('company', Company::first());
        view()->share('lastestBlogs', Blog::where("is_published", "1")->limit(5)->orderBy('created_at', 'DESC')->get());
        view()->share('blogCategories', BlogCategory::withCount('blogs')->get());
        view()->share('types', Type::orderBy('index', 'ASC')->get());
    }
}
