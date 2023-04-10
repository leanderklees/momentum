<?php

namespace Leanderklees\Momentum;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class MomentumServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->commands([
            Console\Commands\ClearTemporaryFiles::class,
            Console\Commands\InsertUpload::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if($this->app->runningInConsole()){
            $this->registerPublishing();
        }
        $this->registerResources();

    }

    protected function registerPublishing(): void
    {
        $this->publishes([
            __DIR__.'/../config/momentum.php' => config_path('momentum.php'),
        ], 'momentum-config');
    }

    private function registerResources(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'momentum');
        $this->registerRoutes();
    }

    protected function registerRoutes(): void
    {
        Route::group($this->routeConfiguration(), function() {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    protected function routeConfiguration(): array
    {
        return [
            'namespace' => 'Leanderklees\Momentum\Http\Controllers',
        ];
    }

}
