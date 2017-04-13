<?php

namespace Munza\Scaffolder\Commands;

use Illuminate\Console\Command;
use Munza\Scaffolder\Traits\FileGeneratable;

class MakeGenerator extends Command
{
    use FileGeneratable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:generator {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new generator class';

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
        $created = $this->createFileFromStub(
            config('scaffolder.paths.generators').'/'.$this->argument('name').'.php',
            __DIR__. '/../../resources/stubs/Generator.php.stub',
            [
                '$NAMESPACE$' => config('scaffolder.namespace'),
                '$NAME$'      => $this->argument('name'),
            ]
        );

        if ($created) {
            $this->info('> Please add the following line at app/Console/Kernel.php file.');
            $this->info('> \\'.config('scaffolder.namespace').'\\'.$this->argument('name').'::class,');
        }
    }
}
