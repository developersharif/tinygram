<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all photos from photos directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = storage_path('app/public/photos');
        if (File::exists($directory)) {
            // Delete all files in the directory recursively
            File::deleteDirectory($directory);
            // Recreate the directory
            File::makeDirectory($directory, 0755, true);
        }

        $this->info('All files in storage/photos have been deleted.');
    }
}