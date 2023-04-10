<?php

namespace Leanderklees\Momentum\Console\Commands;

use Illuminate\Console\Command;
use Leanderklees\Momentum\Momentum;
use Leanderklees\Momentum\Http\Controllers\UploadController;

class ClearTemporaryFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'momentum:clear-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old temporary files from filesystem';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (Momentum::configNotPublished()) {
            if ($this->confirm('Do you want to execute php artisan vendor:publish --tag=momentum-config', true)) {
                $this->call('vendor:publish', ['--tag' => 'momentum-config']);
            } else {
                return $this->warn('Config file not published. Some features may not work correctly.');
            }
        }
        $uploadController = new UploadController();
        $uploadController->clearTemporaryFiles();
        $this->info('momentum:clear-files');
    }
}
