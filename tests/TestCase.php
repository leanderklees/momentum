<?php

namespace Leanderklees\Momentum\Tests;

use Leanderklees\Momentum\MomentumServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
	/**
     * Setup the test environment.
     *
     * @return void
     */
	protected function setUp(): void
    {
    	parent::setUp();
        // Factory::guessFactoryNamesUsing(function (string $modelName) {
        //    return 'Leanderklees\\Momentum\\Database\\Factories\\'.class_basename($modelName).'Factory';
        // });
        // $this->withFactories(__DIR__.'/../database/factories');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app)
    {
    	return [
    		MomentumServiceProvider::class,
    	];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
        	'driver' => 'sqlite',
        	'database' => ':memory:',
        ]);
    }

    protected function setUpMomentumConfig()
    {
        $this->app['config']->set('momentum', include __DIR__.'/../config/momentum.php');
    }

    protected function disableFeature(string $feature)
    {
    	$this->app['config']->set('momentum', [$feature => ['enabled' => false]]);
    }

    protected function enableFeature(string $feature)
    {
    	$this->app['config']->set('momentum', [$feature => ['enabled' => true]]);
    }
}
