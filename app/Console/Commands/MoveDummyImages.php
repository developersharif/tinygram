<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MoveDummyImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photos:move';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dummy Images move to Photos directory from images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $images = storage_path('app/public/images');
        $photos = storage_path('app/public/photos');
        if (File::isDirectory($images) && File::isDirectory($photos)) {
            $files = File::allFiles($images);

            foreach ($files as $file) {
                $destinationPath = $photos . '/' . $file->getRelativePathname();

                File::copy($file->getPathname(), $destinationPath);

                echo 'Moved ' . $file->getRelativePathname() . " successfully.\n";
            }
        } else {
            echo 'Source and/or destination folder does not exist.<br>';
        }
    }
}