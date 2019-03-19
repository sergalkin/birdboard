<?php

namespace App\Providers;

use App\Observers\ProjectObserver;
use App\Observers\TaskObserver;
use App\Project;
use App\Task;
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
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Project::observe(ProjectObserver::class);
        Task::observe(TaskObserver::class);
    }
}
