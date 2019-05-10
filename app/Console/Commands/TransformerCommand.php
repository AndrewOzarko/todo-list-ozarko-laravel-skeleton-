<?php

namespace App\Console\Commands;

use App\Ship\Services\EloquentHelperService;
use Illuminate\Console\Command;

class TransformerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-transformer {transformerName}, {moduleName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new transformer';

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
        $transformerName = $this->argument('transformerName');
        $moduleName = $this->argument('moduleName');

        $this->action($transformerName, $moduleName);
    }

    /**
     * @param string $transformerName
     * @param string $moduleName
     */
    protected function action(string $transformerName, string $moduleName)
    {

        $transformerTemplate = str_replace(
            ['{{transformerName}}', '{{moduleName}}'],
            [$transformerName, $moduleName],
            $this->getStub('Transformer')
        );


        if(!file_exists($path = app_path('Modules/'.$moduleName.'/Transformers')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("Modules/{$moduleName}/Transformers/{$transformerName}Transformer.php"), $transformerTemplate);

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
