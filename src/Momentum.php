<?php

namespace Leanderklees\Momentum;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class Momentum{

	public static function configNotPublished() :bool
	{
		return is_null(config('momentum'));
	}

	public static function missesTemporaryFilesTable() :bool
	{
		return !Schema::hasTable('temporary_files');
	}

	public static function viewNotExistent(string $view) :bool
	{
		return !File::exists(resource_path('views/' . $view . '.blade.php'));
	}

	public static function getViewContents(string $viewPath)
	{
		return File::get($viewPath);
	}

	public static function viewMissesFileInput(string $viewContents)
	{
		return !preg_match('/<form\b[^>]*>.*<input\b[^>]*type=[\'"]file[\'"][^>]*>/is', $viewContents, $output_array);
	}

	public static function addEnctypeToFormTag(string $viewContents)
	{
	    if (!preg_match('/enctype\s*=\s*[\"\']multipart\/form-data[\"\']/', $viewContents)){
		    $viewContents = preg_replace(
		        '/(<form\b[^>]*)(\s*[^>]*)>/isU',
		        '$1$2 enctype="multipart/form-data">',
		        $viewContents
		    );
		}

		return $viewContents;
	}

	public static function hasHeadSection($viewContents) :bool
	{
		return preg_match('/<head\s*>/', $viewContents);
	}

	public static function modifyInputTag(string $viewContents)
	{
		return preg_replace(
		    '/<input(?=[^>]*\btype=["\']file["\'])(?![^>]*\bname=["\']filepond["\'])\b([^>]*)>/i',
		    '<input name="filepond" credits="false"' . '$1' . '>',
		    self::removeNameFromFileInputTag($viewContents)
		);
	}

	private static function removeNameFromFileInputTag(string $viewContents)
	{
		return preg_replace(	
			'/<input(?=[^>]*\btype=["\']file["\'])(?=[^>]*\bname=["\'][^"\']*["\'])\b([^>]*)name=[^ >]+/i', 
			'<input$1', 
			$viewContents
		);
	}

	public static function getParentViewName(string $viewPath)
	{
		$engine = View::getEngineFromPath($viewPath);

		if ($engine instanceof \Illuminate\View\Engines\CompilerEngine) {
			$compiledContent = $engine->get($viewPath);
			if (preg_match('/\@yield\s*\([^\)]*parent/', $compiledContent)) {
				$parentViewPath = $engine->getCompiler()->getLastCompiledExtends();
				return basename($parentViewPath, '.blade.php');
			}
		}

		return null;
	}


	public static function addScriptStackToChildView(string $viewContents)
	{
		$lastClosingTag = strrpos($viewContents, '</');
		if (!$lastClosingTag) {
			return $this->error('View does not have a closing tag: ' . $view);
		}

		$script = self::getFilePondPageScript();

		return substr_replace($viewContents, $script, $lastClosingTag, 0);
	}

	public static function addScriptsBeforeBodyIfNotPresent(string $viewContents)
	{
		if (self::hasScriptTag($viewContents))
		{
			return $viewContents;
		}
	
		return self::addScriptsBeforeBody($viewContents);
	}

	public static function addScriptsBeforeBody(string $viewContents)
	{
		return preg_replace('/<\/body>/', self::getFilePondPageScript() . '</body>', $viewContents);
	}

	public static function addScriptStackToParentView(string $viewContents)
	{
		$stack = <<<EOT
			@stack('scripts')
		</body>
		EOT;
		return preg_replace('/<\/body>/', $stack, $viewContents);
	}

	public static function editMasterViewContents(){
		// tijdelijke oplossing, getParentViewName werkt niet altijd.
		$masterViewPath = resource_path('views\layouts\app.blade.php');
        $masterViewContents = self::getViewContents($masterViewPath);
        $masterViewContents = self::addStyleTagToHeadIfNotPresent($masterViewContents);
        file_put_contents($masterViewPath, $masterViewContents);

        $masterViewPath = resource_path('views\layouts\guest.blade.php');
        $masterViewContents = self::getViewContents($masterViewPath);
        $masterViewContents = self::addStyleTagToHeadIfNotPresent($masterViewContents);
        file_put_contents($masterViewPath, $masterViewContents);
	}

	public static function addStyleTagToHeadIfNotPresent(string $viewContents)
	{
		if (self::hasStyleTag($viewContents))
		{
			return $viewContents;
		}

		return self::addStyleTagToHead($viewContents);
	}

	private static function addStyleTagToHead(string $viewContents)
	{	
		$style = <<<EOT
			<link href="https://unpkg.com/filepond@4.30.4/dist/filepond.css" rel="stylesheet">
		</head>
		EOT;
		return preg_replace('/<\/head>/', $style, $viewContents);
	}

	private static function hasStyleTag(string $viewContents) :bool
	{
		return preg_match('/<link\s+href="https:\/\/unpkg\.com\/filepond/', $viewContents);
	}

	private static function hasScriptTag(string $viewContents) :bool
	{
		return preg_match('/<script\s+src="https:\/\/unpkg\.com\/filepond[^"]*">/', $viewContents);
	}

	private static function getFilePondPageScript()
	{
		return <<<EOT
			<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
			<script>
				const inputElement = document.querySelector('input[type="file"]');

				const pond = FilePond.create(inputElement);

				FilePond.setOptions({
					server: {
						process: '/upload/fp-upload',
						revert: '/upload/fp-delete',
						headers: {
							'X-CSRF-TOKEN': '{{ csrf_token() }}'
						}
					},
				});
			</script>
		EOT;
	}
}