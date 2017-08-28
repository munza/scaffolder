<?php

namespace Munza\Scaffolder\Traits;

use Illuminate\Filesystem\Filesystem;

trait FileGeneratable
{
    /**
     * Create a file from stub and data.
     *
     * @param  string $target
     * @param  string $stub
     * @param  array  $data
     * @return bool
     */
    private function createFileFromStub(string $target, string $stub, array $data)
    {
        // check if the file already exists
        if (file_exists($target)) {
            $this->error('File already exists!');
            return false;
        }

        // create folder path for the target file
        if (! file_exists($this->filesystem()->isDirectory(dirname($target)))) {
            $this->filesystem()->makeDirectory(dirname($target), 0777, true, true);
        }

        // make the stub file
        $content = app('view')->make($stub, $data);

        // write the file in the target path
        $this->filesystem()->put($target, $content);

        return true;
    }

    /**
     * Get a new Filesystem instance.
     *
     * @return \Illuminate\Filesystem\Filesystem
     */
    private function filesystem()
    {
        return new Filesystem;
    }

    /**
     * Get the Console contract.
     *
     * @return \Illuminate\Contracts\Console\Kernel
     */
    private function console()
    {
        return app('Illuminate\Contracts\Console\Kernel');
    }
}
