<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeHelperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Usage:
     * php artisan make:helper ImageUpload
     */
    protected $signature = 'make:helper {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a helper file inside app/Helpers directory';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->argument('name');

        $helpersPath = app_path('Helpers');
        $filePath = $helpersPath . '/' . $name . '.php';

        // Ensure Helpers directory exists
        if (! File::exists($helpersPath)) {
            File::makeDirectory($helpersPath, 0755, true);
        }

        // Prevent overwrite
        if (File::exists($filePath)) {
            $this->error("Helper {$name} already exists!");
            return self::FAILURE;
        }

        $functionName = lcfirst($name);

        // Helper file content
        $content = <<<PHP
<?php

if (! function_exists('{$functionName}')) {

    function {$functionName}()
    {
        // Helper logic here
    }
}
PHP;

        File::put($filePath, $content);

        $this->info("Helper {$name} created successfully at app/Helpers/{$name}.php");

        return self::SUCCESS;
    }
}
