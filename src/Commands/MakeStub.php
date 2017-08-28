<?php

namespace Munza\Scaffolder\Commands;

use Illuminate\Console\Command;
use Munza\Scaffolder\Traits\FileGeneratable;

class MakeStub extends Command
{
    use FileGeneratable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:stub {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new stub class';

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
            $this->info('Stub created successfully.');
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
            config('scaffolder.paths.stubs').'/'.$this->argument('name').'.blade.php',
            'scaffolder::stub',
            [
                'class' => $this->argument('name'),
            ]
        );
    }
}
