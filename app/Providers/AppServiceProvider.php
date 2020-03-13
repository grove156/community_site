<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    protected $subscribe = [
      \App\Listeners\UsersEventListener::class,
    ];

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
      view()->composer('*', function ($view){
        $viewName = $view->getName();
        View::share('viewName', $viewName);
        $allTags = \Cache::rememberForever('tags.list', function (){
          return \App\Tag::all();
        });
        $currentUser = auth()->user();
        $view->with(compact('allTags','currentUser'));

      });
    }
}
