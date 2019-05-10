<?php

namespace App\Console\Commands;

use App\Ship\Services\EloquentHelperService;
use Illuminate\Console\Command;

class EntityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-model {entityName}, {moduleName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new entity';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $entityName = $this->argument('entityName');
        $moduleName = $this->argument('moduleName');

        $this->action($entityName, $moduleName);
    }

    /**
     * @param string $entityName
     * @param string $moduleName
     */
    protected function action(string $entityName, string $moduleName)
    {

        $entityTemplate = str_replace(
            ['{{entityName}}', '{{moduleName}}'],
            [$entityName, $moduleName],
            $this->getStub('Entity')
        );


        if(!file_exists($path = app_path('Modules/'.$moduleName.'/Entities')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("Modules/{$moduleName}/Entities/{$entityName}.php"), $entityTemplate);

    }

    /**
     * @param string $name
     * @return false|string
     */
    protected function getStub(string $name)
    {
        return file_get_contents(resource_path("stubs/{$name}.stub"));
    }

}
