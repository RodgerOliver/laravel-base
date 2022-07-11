<?php

namespace App\Console\Commands\MeiliSearch;

use Illuminate\Console\Command;
use MeiliSearch\Client;
use MeiliSearch\Exceptions\ApiException;

class Filterable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meili:filterable {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update filterable attributes on index of the model';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Client $client)
    {
        $class = $this->argument('model');
        $model = new $class;
        $index = $model->searchableAs();

        try {
            $this->info("Updating filterable attributes for [$class] on index [$index]");
            $client->index($index)->updateFilterableAttributes($model::getSearchFilterAttributes());

        } catch (ApiException $exception) {
            $this->warn($exception->getMessage());
            return self::FAILURE;
        }

        return 0;
    }
}
