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
     * @return void
     */
    private function createFileFromStub($target, $stub, $data)
    {
        if (file_exists($target)) {
            $this->info("> ".$this->getShortPath($target).' already exists.');
            return false;
        }

        if (! file_exists($this->filesystem()->isDirectory(dirname($target)))) {
            $this->filesystem()->makeDirectory(dirname($target), 0777, true, true);
        }

        $stub = file_get_contents($stub);
        $stub = $this->replace($stub, $data);

        $this->filesystem()->put($target, $stub);

        $this->info($this->getShortPath($target).' is created.');

        return true;
    }

    /**
    * Replace key with value in stub.
    *
    * @param  string $stub
    * @param  array  $data
    * @return string
    */
   private function replace($stub, $data)
   {
       foreach ($data as $needle => $value) {
           $stub = str_replace($needle, $value, $stub);
       }
       return $stub;
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
     * Remove the base base part from a full path.
     *
     * @param  string  $fullPath
     * @return string
     */
    private function getShortPath($fullPath)
    {
        return str_replace(base_path(), '', $fullPath);
    }
}
