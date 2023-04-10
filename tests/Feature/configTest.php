<?php

namespace Leanderklees\Momentum\Tests\Feature;

use Leanderklees\Momentum\Features;
use Leanderklees\Momentum\Tests\TestCase;

class ConfigTest extends TestCase
{

    /** @test */
    public function test_config_can_be_accessed()
    {
    	$this->setUpMomentumConfig();
        $this->assertNotEquals(null, config('momentum'));
    }

    /** @test */
    public function test_default_filepond_settings_can_be_loaded(){
    	$this->setUpMomentumConfig();
        $this->assertTrue( Features::enabled('filepond') );
    }

    /** @test */
    public function test_filepond_settings_can_be_enabled_or_disabled()
	{
	    // Test with filepond enabled
	    $this->setUpMomentumConfig();
	    $this->assertTrue(Features::enabled('filepond'));

	    // Test with filepond disabled
	    $this->disableFeature('filepond');
	    $this->assertFalse(Features::enabled('filepond'));
		
		// Test with filepond enabled again
		$this->enableFeature('filepond');
	    $this->assertTrue(Features::enabled('filepond'));
	}

    protected function setUpMomentumConfig()
    {
        $this->app['config']->set('momentum', include __DIR__.'/../../config/momentum.php');
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
