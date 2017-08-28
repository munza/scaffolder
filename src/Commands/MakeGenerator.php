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
    protected $signature = 'make:generator
                            {name : name of the generator class}
                            {--S|stub : create stub file}';

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
        if ($this->create()) {
            $this->info('Generator created successfully.');
            $this->info('Please add the following line at app/Console/Kernel.php file.');
            $this->info('\\'.config('scaffolder.namespace').'\\'.$this->argument('name').'::class,');
        }

        if ($this->option('stub')) {
            $this->console()->call('make:stub', [
                'name' => $this->getStubName($this->argument('name')),
            ]);
        }
    }

    /**
     * Create the file.
     *
     * @return bool
     */
    private function create()
    {
        return $this->createFileFromStub(
            config('scaffolder.paths.generators').'/'.$this->argument('name').'.php',
            'scaffolder::generator',
            [
                'class' => $this->argument('name'),
            ]
        );
    }

    /**
     * Get the stub name from the generator name.
     *
     * @param  string $name
     * @return string
     */
    private function getStubName($name)
    {
        preg_match(
            "/^(.*?)(g|G)enerator$/",
            $name,
            $match
        );

        if (count($match) == 0) {
            return strtolower($name);
        } else {
            return strtolower($match[1]);
        }
    }
}
