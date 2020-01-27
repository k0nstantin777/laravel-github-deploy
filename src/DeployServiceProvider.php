<?php


namespace Konstantinn\LaravelGitHubDeploy;

use Illuminate\Support\ServiceProvider;

class DeployServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/deploy.php' => config_path('deploy.php'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}