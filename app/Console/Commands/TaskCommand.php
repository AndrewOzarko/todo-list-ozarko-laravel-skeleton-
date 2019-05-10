<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class TaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-task {taskName} {moduleName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new task';

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
        $moduleName = $this->argument('moduleName');
        $taskName = $this->argument('taskName');

        $this->task($taskName, $moduleName);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['taskName', InputArgument::REQUIRED, 'The name of the task class.'],
            ['moduleName', InputArgument::REQUIRED, 'The name of module will be used.']
        ];
    }

    /**
     * @param string $taskName
     * @param string $moduleName
     */
    protected function task(string $taskName, string $moduleName)
    {
        $taskTemplate = str_replace(
            ['{{taskName}}', '{{moduleName}}'],
            [$taskName, $moduleName],
            $this->getStub('Task')
        );

        if(!file_exists($path = app_path('Modules/'.$moduleName.'/Tasks')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("Modules/{$moduleName}/Tasks/{$taskName}Task.php"), $taskTemplate);

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
