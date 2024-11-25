<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CreateAdminControllers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin-controllers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create multiple admin controllers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // List of controllers to create
        $controllers = [
            'DashboardController',
            'BookController',
            'AuthorController',
            'GenreController',
            'MetaDataController',
        ];

        // Path where controllers will be created
        $namespace = 'Admin';

        // Loop to create each controller
        foreach ($controllers as $controller) {
            $path = "Http/Controllers/{$namespace}/{$controller}";

            if (!file_exists(app_path($path . '.php'))) {
                Artisan::call('make:controller', [
                    'name' => "{$namespace}/{$controller}",
                ]);
                $this->info("Created: {$controller}");
            } else {
                $this->warn("Skipped: {$controller} already exists");
            }
        }

        $this->info('All specified admin controllers have been generated.');
    }
}
