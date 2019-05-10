<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-controller {controller}, {module}, {--object}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller';

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
        $controllerName = $this->argument('controller');
        $moduleName = $this->argument('module');
        $object = $this->option('object');

        $this->action($controllerName, $moduleName, $object);
    }

    /**
     * @param string $controllerName
     * @param string $moduleName
     * @param string|null $objectName
     */
    protected function action(string $controllerName, string $moduleName, string $objectName = null)
    {
        $objectName = (is_null($objectName) || empty($objectName)) ? $controllerName : $objectName;

        $controllerTemplate = str_replace(
            ['{{controllerName}}', '{{moduleName}}', '{{objectName}}'],
            [$controllerName, $moduleName, $objectName],
            $this->getStub('Controller')
        );


        if(!file_exists($path = app_path('Modules/'.$moduleName.'/Http/Controllers')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("Modules/{$moduleName}/Http/Controllers/{$controllerName}Controller.php"), $controllerTemplate);

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
