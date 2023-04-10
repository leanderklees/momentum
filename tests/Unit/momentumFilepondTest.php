<?php

namespace Leanderklees\Momentum\Tests\Feature;

use Leanderklees\Momentum\Momentum;
use Leanderklees\Momentum\Tests\TestCase;

use Illuminate\Filesystem\Filesystem;

class MomentumFilepondTest extends TestCase
{

    /** @test */
    public function test()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function test_viewMissesFileInput_with_form_and_file_input()
    {
        $viewContents = '<form method="POST" action="/upload" enctype="multipart/form-data">
                            <input type="file" name="file">
                         </form>';
        $this->assertFalse(Momentum::viewMissesFileInput($viewContents));
    }

    /** @test */
    public function test_view_has_no_file_input_tag()
    {
        $viewContents = '<form method="POST" action="/submit">
                            <input type="text" name="name">
                         </form>';
        $this->assertTrue(Momentum::viewMissesFileInput($viewContents));
    }

    /** @test */
    public function test_view_has_no_input_tag()
    {
        $viewContents = '<form method="POST" action="/submit">
                         </form>';
        $this->assertTrue(Momentum::viewMissesFileInput($viewContents));
    }

    /** @test */
    public function test_view_has_file_input_tag_without_form()
    {
        $viewContents = '<input type="file" name="file">';
        $this->assertTrue(Momentum::viewMissesFileInput($viewContents));
    }

    /** @test */
    public function test_view_has_no_form_or_input_tag()
    {
        $viewContents = '<div>Some content here</div>';
        $this->assertTrue(Momentum::viewMissesFileInput($viewContents));
    }

    /** @test */
    public function test_add_enctype_to_form_tag_adds_attribute_if_not_present()
    {
        $viewContents = '<form method="POST" action="/upload">
                            <input type="file" name="file">
                         </form>';

        $expectedViewContents = '<form method="POST" action="/upload" enctype="multipart/form-data">
                            <input type="file" name="file">
                         </form>';

        $result = Momentum::addEnctypeToFormTag($viewContents);

        $this->assertEquals($expectedViewContents, $result);
    }

    /** @test */
    public function test_add_EnctypeToFormTag_does_not_add_attribute_if_already_present()
    {
        $viewContents = '<form method="POST" action="/upload" enctype="multipart/form-data">
                            <input type="file" name="file">
                         </form>';

        $result = Momentum::addEnctypeToFormTag($viewContents);

        $this->assertEquals($viewContents, $result);
    }

    /** @test */
    public function test_AddEnctypeToForm_tag_does_not_add_attribute_if_no_form_present()
    {
        $viewContents = '<div>
                            <input type="file" name="file">
                         </div>';

        $result = Momentum::addEnctypeToFormTag($viewContents);

        $this->assertEquals($viewContents, $result);
    }

    /** @test */
    public function test_ModifyInputTag_modifies_input_tag_with_type_file()
    {
        $viewContents = '<input type="file" other="my-file-input">';

        $expectedViewContents = '<input name="filepond" credits="false" type="file" other="my-file-input">';

        $result = Momentum::modifyInputTag($viewContents);

        $this->assertEquals($expectedViewContents, $result);
    }

    /** @test */
    public function test_ModifyInputTag_does_not_modify_input_tag_without_type_file()
    {
        $viewContents = '<input type="text" name="my-text-input">';

        $result = Momentum::modifyInputTag($viewContents);

        $this->assertEquals($viewContents, $result);
    }


    /** @test */
    public function testModifyInputTagModifiesInputTagWithTypeFileAndNameAttribute()
    {
        $viewContents = '<input type="file" name="my-file-input">';

        $expectedViewContents = '<input name="filepond" credits="false" type="file" >';

        $result = Momentum::modifyInputTag($viewContents);

        $this->assertEquals($expectedViewContents, $result);
    }

    /** @test */
    public function test_addScriptsBeforeBody()
    {
        // Create a mock view contents
        $viewContents = '<html><head><title>Test Page</title></head><body><h1>Welcome</h1></body></html>';

        // Add the script to the view contents
        $output = Momentum::addScriptsBeforeBody($viewContents);

        // Assert that the script was added
        $this->assertStringContainsString(
            '<script src="https://unpkg.com/filepond@^4/dist/filepond.js">', 
            $output
        );

        $this->assertStringContainsString(
            "process: '/upload/fp-upload'",
            $output
        );

        $this->assertStringContainsString(
            "revert: '/upload/fp-delete'",
            $output
        );

        $this->assertStringContainsString(
            "'X-CSRF-TOKEN': '{{ csrf_token() }}'",
            $output
        );

        $this->assertStringContainsString(
            '</script></body>',
            $output
        );
    }

    /** @test */
    public function test_Page_Head_Section_Can_Be_Found()
    {
        $viewContents = "<html><head><title>Test Page</title></head><body>Content goes here</body></html>";
        $this->assertTrue(Momentum::hasHeadSection($viewContents));
    }

    /** @test */
    public function test_pageHasHeadSection_returns_false_if_no_head_section_present()
    {
        $viewContents = "<html><body>Content goes here</body></html>";
        $this->assertFalse(Momentum::hasHeadSection($viewContents));
    }


}
