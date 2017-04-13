<?php

namespace Munza\Scaffolder\Generators;

use Illuminate\Console\Command;
use Munza\Scaffolder\Traits\FileGeneratable;

abstract class Generator extends Command
{
    use FileGeneratable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description;

    /**
     * Stub file name.
     *
     * @var string
     */
    protected $stub;

    /**
     * Target file path.
     *
     * @var string
     */
    protected $target;

    /**
     * Variables and values to replace in stub.
     *
     * @var array
     */
    protected $vars;

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
     * Set the target file path.
     *
     * @return string
     */
    abstract public function setTarget();

    /**
     * Set the variable and values to replace in stub.
     *
     * @return array
     */
    abstract public function setVars();

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->target = $this->setTarget();
        $this->vars   = $this->setVars();

        return $this->createFileFromStub(
            $this->target,
            $this->getStub(),
            $this->getVars()
        );
    }

    /**
     * Get the stub file path.
     *
     * @return string
     */
    private function getStub()
    {
        return config('scaffolder.paths.stubs').'/'.$this->stub;
    }

    /**
     * Prepares vars for stub replace.
     *
     * @return array
     */
    private function getVars()
    {
        $preparedVars = [];

        foreach ($this->vars as $key => $value) {
            $preparedVars['$'.strtoupper($key).'$'] = $value;
        }

        return $preparedVars;
    }
}
