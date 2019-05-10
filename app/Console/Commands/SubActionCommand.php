<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SubActionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-subaction {actionName}, {moduleName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $actionName = $this->argument('actionName');
        $moduleName = $this->argument('moduleName');

        $this->action($actionName, $moduleName);
    }


    /**
     * @param string $actionName
     * @param string $moduleName
     */
    protected function action(string $actionName, string $moduleName)
    {
//        $actionTemplate = str_replace(
//            ['{{actionName}}, {{moduleName}}'],
//            [$actionName, $moduleName],
//            $this->getStub('Action')
//        );

        $actionTemplate = str_replace(
            ['{{actionName}}', '{{moduleName}}'],
            [$actionName, $moduleName],
            $this->getStub('SubAction')
        );


        if(!file_exists($path = app_path('Modules/'.$moduleName.'/Actions')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("Modules/{$moduleName}/Actions/{$actionName}SubAction.php"), $actionTemplate);

    }

    /**
     * @param $type
     * @return false|string
     */
    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }
}
