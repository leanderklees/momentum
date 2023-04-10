<?php

namespace Leanderklees\Momentum\Tests\Feature;

use Leanderklees\Momentum\Features;
use Leanderklees\Momentum\Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Leanderklees\Momentum\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Leanderklees\Momentum\Models\TemporaryFile;
use Faker\Factory as Faker;

class FilepondTest extends TestCase
{

    /** @test */
    public function test_uploadcontroller_can_be_loaded()
    {
        $controller = new UploadController();
        $this->assertInstanceOf(UploadController::class, $controller);
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
}
