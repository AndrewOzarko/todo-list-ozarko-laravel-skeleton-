<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class RepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-repository {repositoryName} {modelName} {moduleName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository';

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
     * @param $type
     * @return false|string
     */
    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $repositoryName = $this->argument('repositoryName');
        $modelName = $this->argument('modelName');
        $moduleName = $this->argument('moduleName');

        $this->repository($repositoryName, $modelName, $moduleName);

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['repositoryName', InputArgument::REQUIRED, 'The name of the repository class.'],
            ['modelName', InputArgument::REQUIRED, 'The name of model will be used.'],
            ['moduleName', InputArgument::REQUIRED, 'The name of module will be used.']
        ];
    }

    protected function repository($repositoryName, $modelName, $moduleName)
    {
        $repositoryTemplate = str_replace(
            ['{{repositoryName}}', '{{modelName}}', '{{moduleName}}'],
            [$repositoryName, $modelName, $moduleName],
            $this->getStub('Repository')
        );

        if(!file_exists($path = app_path('Modules/'.$moduleName.'/Repositories')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("Modules/{$moduleName}/Repositories/{$repositoryName}Repository.php"), $repositoryTemplate);
    }
}
