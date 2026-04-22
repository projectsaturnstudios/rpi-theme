<?php

namespace ProjectSaturnStudios\Themes\RPiTheme\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateVueAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'themes:rpi:update-assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Overwrites the Assets for the RPi Theme Module.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $sourceDirectory = base_path('vendor/projectsaturnstudios/rpi-theme/resources');
        $targetDirectory = base_path('resources/themes/rpi-theme');

        if (! File::exists($sourceDirectory)) {
            $this->error("Source directory not found: {$sourceDirectory}");

            return self::FAILURE;
        }

        File::ensureDirectoryExists(base_path('resources/themes'));

        if (File::exists($targetDirectory)) {
            File::deleteDirectory($targetDirectory);
        }

        if (! File::copyDirectory($sourceDirectory, $targetDirectory)) {
            $this->error('Error updating RPi Theme assets.');

            return self::FAILURE;
        }

        $this->info('RPi Theme assets updated successfully.');
        $this->newLine();
        $this->line('Next steps:');
        $this->line("1) Add to resources/css/themes.css: @import '../themes/rpi-theme/css/rpi-theme.css';");

        return self::SUCCESS;
    }
}
