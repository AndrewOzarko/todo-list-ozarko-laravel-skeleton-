<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RequestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-request {requestName}, {moduleName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new request';

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
        $requestName = $this->argument('requestName');
        $moduleName = $this->argument('moduleName');

        $this->action($requestName, $moduleName);
    }

    /**
     * @param string $requestName
     * @param string $moduleName
     */
    protected function action(string $requestName, string $moduleName)
    {
        $requestTemplate = str_replace(
            ['{{requestName}}', '{{moduleName}}'],
            [$requestName, $moduleName],
            $this->getStub('Request')
        );


        if(!file_exists($path = app_path('Modules/'.$moduleName.'/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("Modules/{$moduleName}/Http/Requests/{$requestName}Request.php"), $requestTemplate);

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
