<?php

namespace App\Providers;

use App\GitHub\GitHubApiGateway;
use App\Services\GitHubService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\GitHub\ApiGateway', function ($app) {
            return new GitHubApiGateway();
        });

        $this->app->singleton('App\Services\GitHubService', function ($app) {
            return new GitHubService($app->make('App\GitHub\ApiGateway'));
        });
    }
}
