<?php

namespace Munza\Scaffolder\Traits;

use Munza\Scaffolder\Traits\FileGeneratable;

trait GeneratorHandler
{
    use FileGeneratable;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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
            array_push($preparedVars, [
                '$'.strtoupper($key).'$' => $value,
            ]);
        }

        return $preparedVars;
    }
}
