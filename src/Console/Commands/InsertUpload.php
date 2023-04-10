<?php

namespace Leanderklees\Momentum\Console\Commands;

use Illuminate\Console\Command;
use Leanderklees\Momentum\Momentum;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;


use Illuminate\Database\Migrations\MigrationRepositoryInterface;
use Illuminate\Support\Facades\App;

class InsertUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'momentum:insert-upload {view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'inserts Filepond to a page ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("documentation can be found at /momentum");
        
        // check database connection is setup correctly
        try {
            $pdo = DB::connection()->getPdo();
        } catch (\Exception $e) {
            $this->error("This functionality uses the database of the application. No Database is found at the moment");
            return;
        }

        $view = $this->argument('view');
        $viewPath = resource_path('views/' . $view . '.blade.php');

        if (Momentum::viewNotExistent($view))
        {
            return $this->error('View file does not exist: ' . $view);
        }

        $viewContents = Momentum::getViewContents($viewPath);
        
        if (Momentum::viewMissesFileInput($viewContents)) {
            return $this->error('View file (' . $view . ') does not contain an <input type="file"> tag in the <form> tag');
        }

        $viewContents = Momentum::addEnctypeToFormTag($viewContents);        
        $viewContents = Momentum::modifyInputTag($viewContents);

        if(Momentum::hasHeadSection($viewContents))
        {
            $viewContents = Momentum::addStyleTagToHeadIfNotPresent($viewContents);

            $viewContents = Momentum::addScriptsBeforeBodyIfNotPresent($viewContents);
            $this->info('code is edited, style and script tags added');

            file_put_contents($viewPath, $viewContents);
            $this->info('view is recognized as master layout and is updated');

        } else {
            Momentum::editMasterViewContents();

            $viewContents = Momentum::addScriptStackToChildView($viewContents);

            file_put_contents($viewPath, $viewContents);
            $this->info('code is edited, style and script tags added.');
        }

        if (!env('PUBLIC_DISK_NAME')) {
            file_put_contents(base_path('.env'), "\n \nPUBLIC_DISK_NAME=public\n", FILE_APPEND);
            $this->info('Added PUBLIC_DISK_NAME=public to .env file.');
        }

        $this->info('momentum:insert-upload completed, please run php artisan migrate:fresh if this is your first install');

        if ($this->confirm('Would you like to run php artisan migrate:refresh?')) {
            Artisan::call('migrate:refresh');
            $this->info('Database refreshed.');
        }

        // later use
        // if (Momentum::configNotPublished()) {
        //     if ($this->confirm('Do you want to publish the config file?', true)) {
        //         $this->call('vendor:publish', ['--tag' => 'momentum-config']);
        //     } else {
        //         return $this->warn('Config file not published. At this point it doesn\'t use any config settings yet, in the future the config file will be used to change settings.');
        //     }
        // }
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
