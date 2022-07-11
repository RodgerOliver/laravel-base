<?php

namespace App\Console\Commands\Search;

// use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

class ImportAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:import-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all models into the search index';

    protected $excluded = [
        // User::class,
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $files = File::allFiles(app()->basePath() . '/app/Models');

        collect($files)->map(function(SplFileInfo $file) {
            $filename = $file->getRelativePathname();
            if(substr($filename, -4) !== '.php') {
                return null;
            }
            return substr($filename, 0, -4);
        })
            ->filter(function(?string $class_name) {
                $reflection = new \ReflectionClass($this->modelNamespacePrefix() . $class_name);
                $is_model = $reflection->isSubclassOf(Model::class);
                $searchable = $reflection->hasMethod('search');
                return $class_name && $is_model && $searchable && !in_array($reflection->getName(), $this->excluded, true);
            })
            ->map(function($class_name) {
                $class = app($this->modelNamespacePrefix() . $class_name);
                $index = $class->searchableAs();
                $class_namespace = $this->modelNamespacePrefix() . $class_name;
                $this->info('Importing data from ' . $class_namespace . ' to index ' . $index . '.');
                Artisan::call('scout:import', ['model' => $class_namespace]);
            });

        return 0;
    }

    private function modelNamespacePrefix()
    {
        return app()->getNamespace() . 'Models\\';
    }
}
